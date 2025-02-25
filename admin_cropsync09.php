<?php
session_start();
include 'header.php';
include 'config.php'; 

// Handle user registration
if (isset($_POST['register'])) {
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = password_hash($_POST['password'] ?? '', PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $email, $password);

if ($stmt->execute()) {
    echo "<script>showNotification('User registered successfully.', 'success');</script>";
} else {
    echo "<script>showNotification('Error: " . htmlspecialchars($stmt->error) . "', 'error');</script>";
}

    $stmt->close();
}

// Handle notifications
function addNotification($userId, $quizId, $message) {
    global $conn;
    try {
        $stmt = $conn->prepare("INSERT INTO notifications (user_id, quiz_id, message) VALUES (?, ?, ?)");
        $stmt->bind_param("iis", $userId, $quizId, $message);
        return $stmt->execute();
    } catch (Exception $e) {
        error_log("Error adding notification: " . $e->getMessage());
        return false;
    }
}

// Handle form submission for notification
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['user_id']) && isset($_POST['quiz_id']) && isset($_POST['message'])) {
    $userId = $_POST['user_id'];
    $quizId = $_POST['quiz_id'];
    $message = $_POST['message'];

    if (addNotification($userId, $quizId, $message)) {
        echo "<script>showNotification('Notification added successfully.');</script>";
    } else {
        echo "<script>showNotification('Failed to add notification.');</script>";
    }
}

// Handle link updates
if (isset($_POST['action']) && $_POST['action'] === 'update_links') {
    // Validate and sanitize input
    $user_id = intval($_POST['user_id'] ?? 0);
    $course1_link = filter_var($_POST['course1_link'] ?? '', FILTER_SANITIZE_URL);
    $course2_link = filter_var($_POST['course2_link'] ?? '', FILTER_SANITIZE_URL);
    $certificate1_link = filter_var($_POST['certificate1_link'] ?? '', FILTER_SANITIZE_URL);
    $certificate2_link = filter_var($_POST['certificate2_link'] ?? '', FILTER_SANITIZE_URL);

    // Prepare update query
    $updates = [];
    $params = [];
    $types = '';

    if (!empty($course1_link)) {
        $updates[] = 'course1_link = ?';
        $params[] = $course1_link;
        $types .= 's';
    }
    
    if (!empty($course2_link)) {
        $updates[] = 'course2_link = ?';
        $params[] = $course2_link;
        $types .= 's';
    }
    
    if (!empty($certificate1_link)) {
        $updates[] = 'certificate1_link = ?';
        $params[] = $certificate1_link;
        $types .= 's';
    }
    
    if (!empty($certificate2_link)) {
        $updates[] = 'certificate2_link = ?';
        $params[] = $certificate2_link;
        $types .= 's';
    }

    if ($updates) {
        // Finalize query
        $query = "UPDATE users SET " . implode(', ', $updates) . " WHERE id = ?";
        array_push($params, $user_id);
        $types .= 'i';

        // Execute update
        if ($stmt = $conn->prepare($query)) {
            // Bind parameters
            call_user_func_array([$stmt, 'bind_param'], array_merge([$types], $params));

            if ($stmt->execute()) {
                echo "<script>showNotification('User information updated successfully.');</script>";
            } else {
                echo "<script>showNotification('Error: " . htmlspecialchars($stmt->error) . "');</script>";
            }
            // Close statement
            $stmt->close();
        }
    }
}

function get_all_users($conn) {
    $users = [];

    // Fetch user progress for Course 1
    $sql1 = "
    SELECT 
        u.id, 
        u.name, 
        u.email, 
        u.course1_link,
        u.course2_link,
        u.certificate1_link,
        u.certificate2_link,
        up.quiz_id,
        up.completed
    FROM users u
    LEFT JOIN user_progress up ON u.id = up.user_id
    ORDER BY u.id, up.quiz_id";
    
    $result1 = $conn->query($sql1);
    
    if ($result1->num_rows > 0) {
        while($row = $result1->fetch_assoc()) {
            $user_id = $row['id'];
            if (!isset($users[$user_id])) {
                $users[$user_id] = [
                    'id' => $row['id'],
                    'name' => $row['name'],
                    'email' => $row['email'],
                    'course1_link' => $row['course1_link'],
                    'course2_link' => $row['course2_link'],
                    'certificate1_link' => $row['certificate1_link'],
                    'certificate2_link' => $row['certificate2_link'],
                    'course1_completed' => 0,
                    'course1_total' => 0,
                    'course2_completed' => 0,
                    'course2_total' => 0,
                    'quizzes' => [],
                    'uploads' => []
                ];
            }
            if ($row['quiz_id']) {
                $users[$user_id]['quizzes'][$row['quiz_id']] = [
                    'completed' => $row['completed'],
                ];
                
                // Update course progress for Course 1
                $users[$user_id]['course1_total'] = 7; // Set total quizzes to 7
                if ($row['completed']) {
                    $users[$user_id]['course1_completed']++;
                }
            }
        }
    }

    // Fetch user progress for Course 2
    $sql2 = "
    SELECT 
        u.id, 
        u.name, 
        u.email, 
        cp.quiz_id,
        cp.completed,
        uu.file_name,
        uu.file_path,
        uu.upload_date
    FROM users u
    LEFT JOIN course2_progress cp ON u.id = cp.user_id
    LEFT JOIN user_uploads uu ON u.id = uu.user_id
    ORDER BY u.id, cp.quiz_id";
    
    $result2 = $conn->query($sql2);
    
    if ($result2->num_rows > 0) {
        while($row = $result2->fetch_assoc()) {
            $user_id = $row['id'];
            if (!isset($users[$user_id])) {
                $users[$user_id] = [
                    'id' => $row['id'],
                    'name' => $row['name'],
                    'email' => $row['email'],
                    'course1_link' => $row['course1_link'],
                    'course2_link' => $row['course2_link'],
                    'certificate1_link' => $row['certificate1_link'],
                    'certificate2_link' => $row['certificate2_link'],
                    'course2_completed' => 0,
                    'course2_total' => 0,
                    'quizzes' => [],
                    'uploads' => []
                ];
            }
            if ($row['quiz_id']) {
                // Update course progress for Course 2
                $users[$user_id]['course2_total'] = 7; // Set total quizzes to 7
                if ($row['completed']) {
                    $users[$user_id]['course2_completed']++;
                }
            }
            if ($row['file_name'] && $row['file_path']) {
                $users[$user_id]['uploads'][] = [
                    'quiz_id' => $row['quiz_id'],
                    'file_name' => $row['file_name'],
                    'file_path' => $row['file_path'],
                    'upload_date' => $row['upload_date']
                ];
            }
        }
    }
    
    return array_values($users);
}

$all_users = get_all_users($conn);


$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - User Management</title>
    <!-- Include Bootstrap CSS for styling -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Custom CSS for dashboard layout -->
    <style>
        body {
            font-family: Poppins, sans-serif;
            background-color: #f8f9fa;
        }

        /* Sidebar styling */
        .sidebar {
            height: 100vh;
            width: 250px;
            position: fixed;
            top: 0;
            left: 0;
            background-color: #343a40;
            padding-top: 20px;
            transition: width 0.3s;
        }

        .sidebar a {
            padding: 15px;
            text-decoration: none;
            font-size: 18px;
            color: white;
            display: block;
        }

        .sidebar a:hover {
            background-color: #495057;
        }

        .sidebar a.active {
            background-color: #007bff;
        }

        .content {
            margin-left: 250px;
            margin-top: 30Px;
            padding: 20px;
        }

        /* Responsive adjustments */
        @media screen and (max-width: 768px) {
            .sidebar {
                width: 80px;
            }

            .content {
                margin-left: 80px;
            }

            .sidebar a {
                font-size: 14px;
                padding: 10px;
                text-align: center;
            }

            .sidebar a span {
                display: none;
            }
        }

        /* Form styling */
        form {
            margin-bottom: 20px;
        }

        form input,
        form textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 5px;
            border: 1px solid #ced4da;
        }

        /* Table styling */
        table {
            width: 100%;
            margin-bottom: 30px;
        }

        table th,
        table td {
            text-align: center;
        }

        /* Success message styling */
        .alert {
            margin-top: 20px;
        }

        /* Notification form and resolve form styling */
        .notification-form,
        .resolve-form {
            margin-bottom: 30px;
        }

        .notification-form .form-control,
        .resolve-form .form-control {
            margin-bottom: 10px;
        }

        /* Mobile adjustments for table */
        @media (max-width: 768px) {
            table th,
            table td {
                font-size: 12px;
            }

            table th:nth-child(4),
            table th:nth-child(5),
            table th:nth-child(6),
            table th:nth-child(7) {
                display: none;
            }
        }
.notification-container {
    position: fixed;
    top: 20px;
    right: 20px;
    background-color: white;
    border-radius: 8px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    padding: 20px;
    display: none;
    z-index: 1000;
    width: 300px;
}

.notification-container.success {
    border-left: 5px solid #28a745;
}

.notification-container.error {
    border-left: 5px solid #dc3545;
}

.notification-icon {
    width: 30px;
    height: 30px;
    display: inline-block;
    vertical-align: middle;
    margin-right: 10px;
}

.notification-message {
    display: inline-block;
    vertical-align: middle;
}

.notification-success-icon {
    color: #28a745;
}

.notification-error-icon {
    color: #dc3545;
}

@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(-20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes fadeOut {
    from {
        opacity: 1;
        transform: translateY(0);
    }
    to {
        opacity: 0;
        transform: translateY(-20px);
    }
}

    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <a href="#" class="active"><span>Dashboard</span></a>
        <a href="#register-user-section"><span>Register</span></a>
        <a href="#notification-section"><span>Notifications</span></a>
        <a href="#update-section"><span>Courses</span></a>
        <a href="#user-section"><span>Users</span></a>
    </div>

    <!-- Main Content -->
    <div class="content">
        <h2>Admin Dashboard</h2>

        <?php
        if (isset($_SESSION['message'])): ?>
            <div class="alert alert-<?= $_SESSION['msg_type'] ?>"><?= $_SESSION['message'] ?></div>
        <?php
        unset($_SESSION['message']);
        endif;
        ?>

        <!-- User Registration Form -->
        <section id="register-user-section">
        <h4>Register User</h4>
        <form action="admin_cropsync09.php" method="post">
            <input type="hidden" name="action" value="register">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" name="name" id="name" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" name="email" id="email" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" name="password" id="password" required>
            </div>
            <button type="submit" class="btn btn-primary" name="register">Register</button>
        </form>
        </section>

        <!-- Notification Form -->
        <section id="notification-section">
        <h4>Add Notification</h4>
        <form action="admin_cropsync09.php" method="POST" class="notification-form">
            <label for="user_id">User ID:</label>
            <input type="number" name="user_id" id="user_id" required>

            <label for="quiz_id">Quiz ID:</label>
            <input type="number" name="quiz_id" id="quiz_id" required>

            <label for="message">Message:</label>
            <textarea name="message" id="message" required></textarea>

            <input type="submit" class="btn btn-primary" value="Add Notification">
        </form>
        </section>

        <!-- Update Links Form -->
        <section id="update-section">
        <h4>Update Links</h4>
        <form action="admin_cropsync09.php" method="post">
            <input type="hidden" name="action" value="update_links">
            <div class="form-group">
                <label for="update_user_id">User ID</label>
                <input type="number" class="form-control" name="user_id" id="update_user_id" required>
            </div>
            <div class="form-group">
                <label for="course1_link">Course 1 Link</label>
                <input type="text" class="form-control" name="course1_link" id="course1_link">
            </div>
            <div class="form-group">
                <label for="course2_link">Course 2 Link</label>
                <input type="text" class="form-control" name="course2_link" id="course2_link">
            </div>
            <div class="form-group">
                <label for="certificate1_link">Certificate 1 Link</label>
                <input type="text" class="form-control" name="certificate1_link" id="certificate1_link">
            </div>
            <div class="form-group">
                <label for="certificate2_link">Certificate 2 Link</label>
                <input type="text" class="form-control" name="certificate2_link" id="certificate2_link">
            </div>
            <button type="submit" class="btn btn-primary">Update Links</button>
        </form>
        </section>

        <!-- User List Table -->
        <section id="user-section">
        <h4>User List</h4>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Course 1 Link</th>
                    <th>Course 2 Link</th>
                    <th>Certificate 1 Link</th>
                    <th>Certificate 2 Link</th>
                    <th>Course 1 Progress</th>
                    <th>Course 2 Progress</th>
                    <th>Uploads</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($all_users as $user): ?>
                    <tr>
                        <td><?= $user['id'] ?></td>
                        <td><?= $user['name'] ?></td>
                        <td><?= $user['email'] ?></td>
                        <td><a href="<?= htmlspecialchars($user['course1_link']) ?>" target="_blank">Link</a></td>
                        <td><a href="<?= htmlspecialchars($user['course2_link']) ?>" target="_blank">Link</a></td>
                        <td><a href="<?= htmlspecialchars($user['certificate1_link']) ?>" target="_blank">Link</a></td>
                        <td><a href="<?= htmlspecialchars($user['certificate2_link']) ?>" target="_blank">Link</a></td>
                        <td><?= $user['course1_completed'] ?> / <?= $user['course1_total'] ?></td>
                        <td><?= $user['course2_completed'] ?> / <?= $user['course2_total'] ?></td>
                        <td>
                            <?php foreach ($user['uploads'] as $upload): ?>
                                <a href="<?= htmlspecialchars($upload['file_path']) ?>" target="_blank"><?= htmlspecialchars($upload['file_name']) ?></a> (<?= $upload['upload_date'] ?>)<br>
                            <?php endforeach; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    </section>
<div id="notification-box" class="notification-container">
    <span id="notification-icon" class="notification-icon">
        <!-- SVG icons will be inserted here dynamically -->
    </span>
    <span id="notification-message" class="notification-message"></span>
</div>

    <!-- JavaScript for Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
function showNotification(message, type) {
    const notificationBox = document.getElementById('notification-box');
    const notificationMessage = document.getElementById('notification-message');
    const notificationIcon = document.getElementById('notification-icon');

    notificationMessage.textContent = message;

    if (type === 'success') {
        notificationBox.classList.add('success');
        notificationBox.classList.remove('error');
        notificationIcon.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" class="notification-success-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>`;
    } else if (type === 'error') {
        notificationBox.classList.add('error');
        notificationBox.classList.remove('success');
        notificationIcon.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" class="notification-error-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>`;
    }

    // Show notification
    notificationBox.style.display = 'block';
    notificationBox.style.animation = 'fadeIn 0.3s ease-in-out';

    // Hide after 3 seconds
    setTimeout(() => {
        notificationBox.style.animation = 'fadeOut 0.3s ease-in-out';
        setTimeout(() => notificationBox.style.display = 'none', 300);
    }, 3000);
}

        </script>
</body>
</html>
