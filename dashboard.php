<?php
session_start();
include 'config.php';
include 'header.php';

// Redirect to login if user is not logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Handle profile image upload
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['profile_image'])) {
    $target_dir = "user_uploads/";
    $target_file = $target_dir . basename($_FILES['profile_image']['name']);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if image file is an actual image
    $check = getimagesize($_FILES['profile_image']['tmp_name']);
    if ($check === false) {
        $uploadOk = 0;
    }

    // Check if file already exists
    if (file_exists($target_file)) {
        $uploadOk = 0;
    }

    // Allow certain file formats
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 1) {
        if (move_uploaded_file($_FILES['profile_image']['tmp_name'], $target_file)) {
            // Update the database with the profile image path
            $sql = "UPDATE users SET profile_image = ? WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("si", $target_file, $user_id);
            $stmt->execute();
            $stmt->close();
        }
    }
}

// Prepare the SQL statement to fetch user details
$sql = "SELECT name, course1_link, course2_link, certificate1_link, certificate2_link, profile_image FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);

if ($stmt) {
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $stmt->bind_result($name, $course1_link, $course2_link, $certificate1_link, $certificate2_link, $profile_image);
    $stmt->fetch();
    $stmt->close();
    
    // Store course links in session
    $_SESSION['course1_link'] = $course1_link;
    $_SESSION['course2_link'] = $course2_link;
} else {
    die("Database error: " . $conn->error);
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard | CropSync</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');

        :root {
            --primary-color: #2563eb;
            --secondary-color: #1e40af;
            --success-color: #059669;
            --background-color: #f8fafc;
            --card-background: #ffffff;
            --text-primary: #1e293b;
            --text-secondary: #64748b;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--background-color);
            color: var(--text-primary);
            line-height: 1.6;
            justify-content: center;
            align-items: center;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem;
        }

        .dashboard-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 2rem;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .profile-section {
            display: flex;
            align-items: center;
            gap: 1.5rem;
        }

        .profile-image-container {
            position: relative;
        }

        .profile-image {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            object-fit: cover;
            border: 4px solid var(--card-background);
            box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1);
            transition: transform 0.3s ease;
        }

        .profile-image:hover {
            transform: scale(1.05);
        }

        .user-info h1 {
            font-size: 2rem;
            font-weight: 700;
            color: var(--text-primary);
            margin-bottom: 0.5rem;
        }

        .dashboard-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 1.5rem;
            margin-top: 2rem;
        }

        .dashboard-card {
            background: var(--card-background);
            border-radius: 1rem;
            padding: 1.5rem;
            box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .dashboard-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 15px -3px rgb(0 0 0 / 0.1);
        }

        .card-header {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin-bottom: 1rem;
        }

        .card-header i {
            font-size: 1.5rem;
            color: var(--primary-color);
        }

        .card-header h2 {
            font-size: 1.25rem;
            font-weight: 600;
            color: var(--text-primary);
        }

        .course-list, .certificate-list {
            list-style: none;
        }

.course-item, .certificate-item {
    display: flex;
    align-items: center;
    padding: 0.75rem;
    background: #f8fafc;
    border-radius: 0.5rem;
    margin-bottom: 0.75rem;
    gap: 1rem; /* Adjust the value for more or less space */
    transition: background-color 0.3s ease;
}


        .course-item:hover, .certificate-item:hover {
            background: #f1f5f9;
        }

        .course-item a, .certificate-item a {
            color: var(--text-primary);
            text-decoration: none;
            font-weight: 500;
            flex: 1;
        }

        .upload-section {
            margin-top: 2rem;
        }

        .file-upload {
            display: flex;
            gap: 1rem;
            align-items: center;
            flex-wrap: wrap;
        }

        .custom-file-upload {
            padding: 0.75rem 1.5rem;
            background: var(--primary-color);
            color: white;
            border-radius: 0.5rem;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .custom-file-upload:hover {
            background: var(--secondary-color);
        }

        .upload-button {
            padding: 0.75rem 1.5rem;
            background: var(--success-color);
            color: white;
            border: none;
            border-radius: 0.5rem;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .upload-button:hover {
            background: #047857;
        }

 .logout-button {
            padding: 0.75rem 1.5rem;
            background: #ef4444;
            color: white;
            border: none;
            border-radius: 0.5rem;
            cursor: pointer;
            transition: background-color 0.3s ease;
            display: flex;
        }

        .logout-button:hover {
            background: #dc2626; /* Darker red on hover */
        }

        .logout-button i {
            margin-right: 0.5rem;
        }

        .notification {
            position: fixed;
            top: 20px;
            right: 20px;
            padding: 1rem;
            border-radius: 0.5rem;
            background: var(--primary-color);
            color: white;
            display: none;
            animation: slideIn 0.3s ease;
            z-index: 9999;
            font-family: 'Poppins', sans-serif;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }


        @keyframes slideIn {
            from {
                transform: translateX(100%);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        footer {
            margin-top: 3rem;
            text-align: center;
            padding: 1.5rem;
            background: var(--card-background);
            color: var(--text-secondary);
        }

        @media (max-width: 768px) {
            .container {
                padding: 1rem;
            }

            .dashboard-header {
                flex-direction: column;
                align-items: flex-start;
            }

            .profile-section {
                flex-direction: column;
                text-align: center;
            }

            .dashboard-grid {
                grid-template-columns: 1fr;
            }

            .file-upload {
                flex-direction: column;
                align-items: stretch;
            }
        }
        .logout-container {
    display: flex;
    justify-content: center;
    align-items: center;
    margin-top: 2rem; /* Adjust margin as needed */
}

    </style>
</head>
<body>
    <div class="container">
        <div class="dashboard-header">
            <div class="profile-section">
                <div class="profile-image-container">
                    <?php if ($profile_image): ?>
                        <img src="<?php echo htmlspecialchars($profile_image); ?>" alt="Profile Image" class="profile-image">
                    <?php else: ?>
                        <img src="/api/placeholder/120/120" alt="Profile Image" class="profile-image">
                    <?php endif; ?>
                </div>
                <div class="user-info">
                    <h1>Welcome, <?php echo htmlspecialchars($name); ?>!</h1>
                    <p>Manage your courses and certificates</p>
                </div>
            </div>
        </div>

        <div class="dashboard-grid">
            <div class="dashboard-card">
                <div class="card-header">
                    <i class="fas fa-graduation-cap"></i>
                    <h2>Your Courses</h2>
                </div>
                <ul class="course-list">
                    <?php if ($course1_link): ?>
                        <li class="course-item">
                            <i class="fas fa-book-reader"></i>
                            <a href="<?php echo htmlspecialchars($course1_link); ?>" target="_blank">Supply Chain Manager Course</a>
                        </li>
                    <?php endif; ?>
                    <?php if ($course2_link): ?>
                        <li class="course-item">
                            <i class="fas fa-seedling"></i>
                            <a href="<?php echo htmlspecialchars($course2_link); ?>" target="_blank">Agronomist Course</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>

            <div class="dashboard-card">
                <div class="card-header">
                    <i class="fas fa-certificate"></i>
                    <h2>Your Certificates</h2>
                </div>
                <ul class="certificate-list">
                    <?php if ($certificate1_link): ?>
                        <li class="certificate-item">
                            <i class="fas fa-award"></i>
                            <a href="<?php echo htmlspecialchars($certificate1_link); ?>" target="_blank">Certificate 1</a>
                        </li>
                    <?php endif; ?>
                    <?php if ($certificate2_link): ?>
                        <li class="certificate-item">
                            <i class="fas fa-award"></i>
                            <a href="<?php echo htmlspecialchars($certificate2_link); ?>" target="_blank">Certificate 2</a>
                        </li>
                    <?php endif; ?>
                    <?php if (!$certificate1_link && !$certificate2_link): ?>
                        <li class="certificate-item">No certificates available.</li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>

        <div class="dashboard-card upload-section">
            <div class="card-header">
                <i class="fas fa-user-edit"></i>
                <h2>Update Profile</h2>
            </div>
            <form action="" method="post" enctype="multipart/form-data" id="uploadForm" class="file-upload">
                <label for="profileImage" class="custom-file-upload">
                    <i class="fas fa-cloud-upload-alt"></i> Choose File
                </label>
                <input type="file" name="profile_image" id="profileImage" accept="image/*" style="display: none;">
                <button type="submit" class="upload-button">
                    <i class="fas fa-upload"></i> Upload Profile Image
                </button>
                <div id="fileName" class="file-name"></div>
            </form>
        </div>

    </div>
<div class="logout-container">
    <form action="logout.php" method="post">
        <button type="submit" class="logout-button">
            <i class="fas fa-sign-out-alt"></i> Logout
        </button>
    </form>
</div>

    <div id="notification" class="notification"></div>

    <footer>
        <p>&copy; 2024 CropSync Pvt Ltd. All rights reserved.</p>
    </footer>

    <script>
        document.getElementById('profileImage').addEventListener('change', function() {
            const fileName = this.files[0] ? this.files[0].name : '';
            document.getElementById('fileName').textContent = fileName;
        });

        document.getElementById('uploadForm').addEventListener('submit', function(e) {
            const profileImage = document.getElementById('profileImage').value;
            const notification = document.getElementById('notification');

            if (!profileImage) {
                e.preventDefault();
                notification.textContent = 'Please select an image to upload.';
                notification.style.background = '#ef4444';
                notification.style.display = 'block';
                setTimeout(() => {
                    notification.style.display = 'none';
                }, 3000);
            } else {
                setTimeout(() => {
                    notification.textContent = 'Profile image uploaded successfully!';
                    notification.style.background = '#059669';
                    notification.style.display = 'block';
                    setTimeout(() => {
                        notification.style.display = 'none';
                    }, 3000);
                }, 500);
            }
        });
    </script>
</body>
</html>