<?php
session_start();
include 'config.php';
include 'header.php';

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to the login page
    header("Location: login.php");
    exit;
}

// Function to update progress
function updateProgress($userId, $quizId, $completed) {
    global $conn;
    // Prepare SQL statement
    $stmt = $conn->prepare("
        INSERT INTO user_progress (user_id, quiz_id, completed, completion_date)
        VALUES (?, ?, ?, CURRENT_TIMESTAMP)
        ON DUPLICATE KEY UPDATE completed = VALUES(completed), completion_date = CURRENT_TIMESTAMP
    ");
    $stmt->bind_param("isi", $userId, $quizId, $completed); // "isi" for integer, string, integer

    $result = $stmt->execute();
    if (!$result) {
        error_log("Error updating progress: " . $stmt->error);
    }
    $stmt->close();
    return $result;
}

// Function to get progress
function getProgress($userId) {
    global $conn;
    $progress = array();
    $stmt = $conn->prepare("SELECT quiz_id, completed FROM user_progress WHERE user_id = ?");
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()) {
        $progress[$row['quiz_id']] = $row['completed'];
    }
    $stmt->close();
    return $progress;
}

// Function to calculate overall progress
function calculateOverallProgress($progress, $totalQuizzes) {
    $completedQuizzes = array_sum($progress);
    return ($completedQuizzes / $totalQuizzes) * 100;
}

// Function to fetch unread notifications
function fetchUnreadNotifications($userId) {
    global $conn;
    $notifications = array();
    $stmt = $conn->prepare("SELECT * FROM notifications WHERE user_id = ? AND is_read = FALSE ORDER BY created_at DESC");
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()) {
        $notifications[] = $row;
    }
    $stmt->close();
    return $notifications;
}

// Function to mark notification as read
function markNotificationAsRead($notificationId) {
    global $conn;
    $stmt = $conn->prepare("UPDATE notifications SET is_read = TRUE WHERE notification_id = ?");
    $stmt->bind_param("i", $notificationId);
    return $stmt->execute();
}

// Handle AJAX requests to update progress
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'updateProgress') {
    $quizId = $_POST['quizId'] ?? ''; // Default to empty string if not set
    $completed = $_POST['completed'] === 'true' ? 1 : 0;
    $userId = $_SESSION['user_id'] ?? 0; // Ensure userId is available

    $result = updateProgress($userId, $quizId, $completed);

    // Check for reattempts and delete notifications
    if ($completed == 1) {
        $stmt = $conn->prepare("DELETE FROM notifications WHERE user_id = ? AND quiz_id = ? AND is_resolved = FALSE");
        $stmt->bind_param("ii", $userId, $quizId); // Fixed bind_param types
        $stmt->execute();
        $stmt->close();
    }

    echo json_encode(['success' => $result]);
    exit;
}

// Handle AJAX requests to mark notifications as read
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'markNotificationAsRead') {
    $notificationId = filter_var($_POST['notificationId'], FILTER_VALIDATE_INT);
    
    if ($notificationId && markNotificationAsRead($notificationId)) {
        error_log("Notification {$notificationId} marked as read.");
        echo json_encode(['success' => true]);
    } else {
        error_log("Failed to mark notification {$notificationId} as read.");
        echo json_encode(['success' => false]);
    }
    exit;
}

// Get the user's progress when the page loads
$userId = $_SESSION['user_id'];
$totalQuizzes = 7; // Update this number if you add more quizzes
$userProgress = getProgress($userId);
$overallProgress = calculateOverallProgress($userProgress, $totalQuizzes);

// Fetch unread notifications for the logged-in user
$unreadNotifications = fetchUnreadNotifications($userId);

?>






<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Greenhouses Course</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.plyr.io/3.6.8/plyr.css" />
    <script src="https://cdn.plyr.io/3.6.8/plyr.polyfilled.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.5.1/dist/confetti.browser.min.js"></script>
    <style>
        :root {
    --primary-color: #4CAF50;
    --secondary-color: #45a049;
    --background-color: #f0f8ff;
    --text-color: #333;
    --white: #ffffff;
    --accent-color: #FFA500;
    --hover-color: #66bb6a;
}

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Poppins', sans-serif;
}

body {
    background-color: var(--background-color);
    color: var(--text-color);
    line-height: 1.6;
}

.container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 20px;
    display: grid;
    grid-template-columns: 1fr;
    gap: 30px;
}

.course-title {
    background: linear-gradient(45deg, var(--primary-color), var(--secondary-color));
    color: var(--white);
    padding: 60px 0;
    text-align: center;
    border-radius: 0 0 50% 50% / 30px;
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
    animation: fadeIn 1s ease-out, float 3s ease-in-out infinite;
}


.course-title h1 {
    font-size: 3.5em;
    margin-bottom: 15px;
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
}

.course-title p {
    font-size: 1.3em;
    max-width: 700px;
    margin: 0 auto;
    opacity: 0.9;
}

.progress-container {
    background-color: #e0e0e0;
    border-radius: 20px;
    height: 25px;
    width: 100%;
    overflow: hidden;
    margin-top: 30px;
    box-shadow: inset 0 2px 5px rgba(0, 0, 0, 0.1);
}

.progress-bar {
    background: linear-gradient(90deg, var(--primary-color), var(--accent-color));
    height: 100%;
    width: 0;
    transition: width 0.8s ease-in-out;
    box-shadow: 0 0 10px rgba(76, 175, 80, 0.5);
}

.course-section {
    background-color: var(--white);
    border-radius: 15px;
    overflow: hidden;
    box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.course-section:hover {
    transform: translateY(-5px);
    box-shadow: 0 12px 20px rgba(0, 0, 0, 0.15);
}

.section-header {
    background: linear-gradient(90deg, var(--primary-color), var(--secondary-color));
    color: var(--white);
    padding: 20px;
    cursor: pointer;
    transition: background 0.3s ease, transform 0.3s ease;
    position: relative;
    overflow: hidden;
}

.section-header:hover {
    background: linear-gradient(90deg, var(--secondary-color), var(--primary-color));
    transform: scale(1.02);
}

.section-header::after {
    content: '';
    position: absolute;
    top: -50%;
    left: -50%;
    width: 200%;
    height: 200%;
    background: rgba(255, 255, 255, 0.2);
    transform: rotate(45deg);
    transition: 0.5s;
}

.section-header:hover::after {
    left: 100%;
    top: 100%;
}

.section-content {
    padding: 25px;
    display: none;
    animation: slideDown 0.5s ease-out;
}

@keyframes slideDown {
    from { opacity: 0; transform: translateY(-20px); }
    to { opacity: 1; transform: translateY(0); }
}

.video-container {
    margin-bottom: 25px;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
}

.btn {
    display: inline-block;
    padding: 12px 25px;
    background: linear-gradient(45deg, var(--primary-color), var(--secondary-color));
    color: var(--white);
    text-decoration: none;
    border-radius: 25px;
    transition: all 0.3s ease;
    cursor: pointer;
    border: none;
    font-size: 16px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 1px;
    position: relative;
    overflow: hidden;
    margin: 10px 0;
}

.btn::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
    transition: 0.5s;
}

.btn:hover {
    background: linear-gradient(45deg, var(--secondary-color), var(--primary-color));
    transform: translateY(-3px);
    box-shadow: 0 5px 15px rgba(76, 175, 80, 0.4);
}

.btn:hover::before {
    left: 100%;
}

.quiz {
    margin-top: 25px;
    background-color: #f9f9f9;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
}

.quiz label {
    display: block;
    margin-bottom: 15px;
    cursor: pointer;
    transition: color 0.3s ease;
    padding: 10px;
    border-radius: 5px;
    background-color: #fff;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
}

.quiz label:hover {
    color: var(--primary-color);
    background-color: #f0f0f0;
}

.error-message, .success-message {
    margin-top: 15px;
    padding: 15px;
    border-radius: 5px;
    display: none;
    animation: fadeIn 0.5s ease-out;
    font-weight: bold;
}

.error-message {
    color: #721c24;
    background-color: #f8d7da;
    border: 1px solid #f5c6cb;
}

.success-message {
    color: #155724;
    background-color: #d4edda;
    border: 1px solid #c3e6cb;
}

#completion-message {
    background: linear-gradient(135deg, #4CAF50, #45a049);
    color: white;
    padding: 30px;
    border-radius: 15px;
    text-align: center;
    display: none;
    animation: fadeIn 1s ease-out, pulse 2s infinite;
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
}

@keyframes pulse {
    0% { transform: scale(1); }
    50% { transform: scale(1.05); }
    100% { transform: scale(1); }
}

#confetti-canvas {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    pointer-events: none;
    z-index: 9999;
}




.file-upload-section {
    background: linear-gradient(135deg, #f9f9f9, #f0f0f0);
    padding: 25px;
    border-radius: 15px;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    margin: 30px auto;
}

.file-upload-section h3 {
    font-size: 1.8em;
    margin-bottom: 15px;
    color: var(--primary-color);
}

.file-upload-section p {
    font-size: 1.1em;
    margin-bottom: 25px;
    color: #555;
}

.sample-file-container {
    margin-bottom: 25px;
}

.file-input-container {
    display: flex;
    align-items: center;
    margin-bottom: 20px;
}

.file-input-button {
    background: linear-gradient(45deg, #28a745, #218838);
    color: #fff;
    border: none;
    padding: 12px 25px;
    border-radius: 25px;
    cursor: pointer;
    font-size: 1em;
    margin-right: 15px;
    transition: all 0.3s ease;
}

.file-input-button:hover {
    background: linear-gradient(45deg, #218838, #28a745);
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(40, 167, 69, 0.3);
}

.file-input-container input[type="file"] {
    display: none;
}

.file-input-label {
    font-size: 1em;
    color: #333;
    cursor: pointer;
    padding: 10px 20px;
    border-radius: 25px;
    border: 2px dashed #ddd;
    background-color: #fff;
    flex: 1;
    text-align: center;
    transition: all 0.3s ease;
}

.file-input-label:hover {
    background-color: #f8f8f8;
    border-color: var(--primary-color);
}

.file-name-display {
    font-size: 1em;
    color: #666;
    margin-bottom: 20px;
    padding: 10px;
    background-color: #f0f0f0;
    border-radius: 5px;
    word-break: break-all;
}

.upload-button {
    background: linear-gradient(45deg, #007bff, #0056b3);
    color: #fff;
    border: none;
    padding: 12px 25px;
    border-radius: 25px;
    cursor: pointer;
    font-size: 1em;
    transition: all 0.3s ease;
}

.upload-button:hover {
    background: linear-gradient(45deg, #0056b3, #007bff);
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(0, 123, 255, 0.3);
}

.subsection {
    margin-top: 30px;
    padding: 20px;
    background-color: #f5f5f5;
    border-radius: 10px;
    box-shadow: 0 3px 10px rgba(0,0,0,0.1);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.subsection:hover {
    transform: translateY(-3px);
    box-shadow: 0 5px 15px rgba(0,0,0,0.15);
}

.subsection-title {
    font-size: 1.4em;
    color: var(--primary-color);
    margin-bottom: 15px;
    padding-bottom: 10px;
    border-bottom: 2px solid var(--primary-color);
}

.video-title {
    font-weight: bold;
    margin-top: 20px;
    margin-bottom: 10px;
    color: var(--secondary-color);
}

.video-description {
    font-style: italic;
    margin-bottom: 15px;
    padding: 10px;
}
#notification-badge-container {
    position: fixed;
    top: 20px;
    right: 20px;
    z-index: 9999;
}

.notification-badge {
    background-color: #444;
    color: white;
    padding: 10px;
    margin-bottom: 10px;
    border-radius: 5px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
    opacity: 0;
    transition: opacity 0.5s ease-in-out;
}

.notification-badge.success {
    background-color: #4CAF50;
}

.notification-badge.error {
    background-color: #F44336;
}

    #sample-file-dropdown {
        font-size: 1em;
        color: #333;
        cursor: pointer;
        padding: 10px 20px;
        border-radius: 25px;
        border: 2px dashed #ddd;
        background-color: #fff;
        flex: 1;
        text-align: center;
        transition: all 0.3s ease;
        
        /* Remove default appearance */
        appearance: none;
        -webkit-appearance: none;
        -moz-appearance: none;
        
        /* Add custom dropdown arrow with more spacing */
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%23333' d='M10.293 3.293L6 7.586 1.707 3.293A1 1 0 00.293 4.707l5 5a1 1 0 001.414 0l5-5a1 1 0 10-1.414-1.414z'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 20px center;
        padding-right: 50px; /* Increase right padding for more space around the icon */
    }
    #sample-file-dropdown:focus {
        outline: none;
        border-color: #007bff;
    }
     .custom-dropdown {
        position: relative;
        width: 200px;
    }

    .selected-option {
        font-size: 1em;
        color: #333;
        cursor: pointer;
        padding: 10px 20px;
        border-radius: 25px;
        border: 2px dashed #ddd;
        background-color: #fff;
        text-align: center;
        transition: all 0.3s ease;
    }
        .options {
        display: none;
        position: absolute;
        top: 100%;
        left: 0;
        right: 0;
        background-color: #fff;
        border: 1px solid #ddd;
        border-radius: 4px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        z-index: 1;
    }

    .option {
        padding: 10px;
        cursor: pointer;
    }

    .option:hover {
        background-color: #f0f0f0;
    }
@media (max-width: 768px) {
    body {
        font-size: 14px; /* Slightly increased for better readability */
    }

    .course-title h1 {
        font-size: 1.8em; /* Adjusted for better fit on smaller screens */
    }

    .course-title p {
        font-size: 0.9em; /* Improved readability for paragraphs */
    }

    .btn {
        font-size: 14px; /* Slightly larger text for better touch interaction */
        padding: 12px 24px; /* Adjusted padding for a more balanced button size */
    }
}

footer {
    background-color: #222; /* Darkened for better contrast */
    color: #f0f0f0; /* Changed text color for readability */
    padding: 2.5rem 0; /* Adjusted padding for better spacing */
}

.footer-content {
    display: flex;
    justify-content: space-around; /* More balanced spacing between sections */
    flex-wrap: wrap;
    gap: 1.5rem; /* Added gap for better spacing between items */
}

.footer-section {
    flex: 1;
    margin-bottom: 1.5rem; /* Reduced for better compact layout */
    min-width: 220px; /* Adjusted to maintain a better layout on smaller screens */
}

.footer-section h3 {
    margin-bottom: 1.2rem; /* Slightly increased for better separation */
    font-weight: 600;
    font-size: 1.25rem; /* Adjusted font size for better readability */
}

.footer-section ul {
    list-style: none;
    padding-left: 0; /* Removed padding for better alignment */
}

.footer-section ul li {
    margin-bottom: 0.75rem; /* Increased for better spacing */
}

.footer-section ul li a {
    color: #ccc; /* Softer link color for a better visual experience */
    text-decoration: none;
    transition: color 0.3s ease;
}

.footer-section ul li a:hover {
    color: var(--primary-color); /* Keeps the primary color for hover */
}

.social-icons a {
    color: #f0f0f0; /* Lighter icon color for better contrast */
    font-size: 1.5rem;
    margin-right: 1rem;
    transition: color 0.3s ease;
}

.social-icons a:hover {
    color: var(--primary-color); /* Hover effect using primary color */
}

.footer-bottom {
    text-align: center;
    padding-top: 1.5rem; /* Slightly reduced for a more compact layout */
    border-top: 1px solid #444; /* Softer border color for a more subtle look */
    margin-top: 1.5rem; /* Adjusted spacing for consistency */
    font-size: 0.9rem; /* Slightly smaller font size for a refined footer look */
    color: #bbb; /* Softer text color for footer bottom */
}


.notifications-container {
    position: fixed; /* Fixes the notifications at the bottom */
    bottom: 0; /* Aligns the notifications at the bottom */
    width: 100%; /* Full width */
    max-width: 400px; /* Same width as course dropdowns */
    left: 50%;
    transform: translateX(-90%); /* Centers the container */
}

.notifications {
    background-color: var(--white);
    border-radius: 15px;
   width: 90%; /* Full width */
    padding: 20px;
    box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    margin: 0 auto; /* Centers notifications inside the container */
    max-width: 1000px; /* Ensures the width matches the dropdowns */
}

.notification-item {
    display: flex;
    justify-content: space-between;
    align-items: end;
    padding: 10px;
    border-bottom: 1px solid #f1f1f1;
}

.notification-content {
    flex-grow: 1;
    margin-right: 10px;
}

.notification-title {
    font-weight: bold;
    margin-bottom: 5px;
}

.notification-timestamp {
    color: #888;
    font-size: 12px;
}

.btn-dismiss {
    background-color: #e74c3c;
    color: #fff;
    border: none;
    padding: 5px 10px;
    border-radius: 3px;
    cursor: pointer;
    font-size: 14px;
}

.btn-dismiss:hover {
    background-color: #c0392b;
}

    </style>
</head>
<body>
    <div class="course-title">
        <h1>Greenhouses Course</h1>
        <p>Master the art of greenhouse cultivation and transform your gardening skills</p>
    </div>
<br>
<div class="notifications">
    <h3>Unread Notifications</h3>
    <?php if (empty($unreadNotifications)): ?>
        <p>No unread notifications.</p>
    <?php else: ?>
        <ul id="notification-list">
            <?php foreach ($unreadNotifications as $notification): ?>
                <li data-id="<?php echo $notification['notification_id']; ?>" class="notification-item">
                    <div class="notification-content">
                        <span class="notification-title"><?php echo htmlspecialchars($notification['message']); ?></span>
                        <span class="notification-timestamp"><?php echo $notification['created_at']; ?></span>
                    </div>
                    <button class="btn-dismiss">Dismiss</button>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
</div>

    <div class="container">
        <div class="progress-container">
            <div class="progress-bar" id="progress-bar" style="width: <?php echo $overallProgress; ?>%;"></div>
        </div>
        <p>Your current progress: <span id="progress-percentage"><?php echo round($overallProgress, 2); ?>%</span></p>

<!-- Section 1: Introduction -->
<div class="course-section">
    <div class="section-header" onclick="toggleSection('section1')">
    Section 1: Introduction to Greenhouses
</div>
    <div class="section-content" id="section1">
        <div class="subsection">
            <h3 class="subsection-title">1.1 Basics of Greenhouse Gardening</h3>
            <button class="btn" onclick="toggleVideo('video1_1_container')">Video 1: What is a Greenhouse?</button>
    <div class="video-container" id="video1_1_container">
        <p class="video-description">An overview of greenhouses and their purposes.</p>
        <video width="640" height="360" controls>
    <source src="https://firebasestorage.googleapis.com/v0/b/event-ticket-9b9ca.appspot.com/o/Welcome%20Farmer%20-%20Google%20Chrome%202024-09-18%2015-54-33.mp4?alt=media&token=897cf283-01f7-4b4b-9905-eea785ddc139" type="video/mp4">
</video>
    </div>
            <button class="btn" onclick="toggleVideo('video1_2_container')">Video 2: Benefits of Greenhouse Cultivation</button>
            <div class="video-container" id="video1_2_container" style="display: none;">
                <p class="video-description">Explore the advantages of growing plants in a controlled environment.</p>
                <video id="player1_2" playsinline controls>
                    <source src="greenhouse_benefits.mp4" type="video/mp4" />
                </video>
            </div>
        </div>

        <div class="subsection">
            <h3 class="subsection-title">1.2 Types of Greenhouses</h3>
            <button class="btn" onclick="toggleVideo('video1_3_container')">Video 3: Common Greenhouse Structures</button>
            <div class="video-container" id="video1_3_container" style="display: none;">
                <p class="video-description">Learn about different types of greenhouse designs and their uses.</p>
                <video id="player1_3" playsinline controls>
                    <source src="greenhouse_types.mp4" type="video/mp4" />
                </video>
            </div>
        </div>

        <button class="btn" onclick="showQuiz('quiz1')">Attempt Quiz</button>
        <div class="quiz" id="quiz1" style="display: none;">
            <form onsubmit="return checkQuiz('quiz1')">
                <!-- Question 1 -->
                <div class="quiz-question">
                    <p>1. What is the primary purpose of a greenhouse?</p>
                    <label>
                        <input type="radio" name="q1" value="correct"> a) To grow plants
                    </label>
                    <label>
                        <input type="radio" name="q1" value="incorrect"> b) To store tools
                    </label>
                    <label>
                        <input type="radio" name="q1" value="incorrect"> c) To raise fish
                    </label>
                </div>

                <!-- Question 2 -->
                <div class="quiz-question">
                    <p>2. What is the best way to increase soil fertility?</p>
                    <label>
                        <input type="radio" name="q2" value="incorrect"> a) Using synthetic pesticides
                    </label>
                    <label>
                        <input type="radio" name="q2" value="correct"> b) Adding organic compost
                    </label>
                    <label>
                        <input type="radio" name="q2" value="incorrect"> c) Using excess water
                    </label>
                </div>

                <button type="submit" class="btn">Submit Quiz</button>
            </form>
            <div class="error-message" id="error-message-quiz1">You need at least 75% to pass this quiz.</div>
            <div class="success-message" id="success-message-quiz1">Congratulations! You've passed the quiz.</div>
        </div>
    </div>
</div>




        <!-- Section 2: Greenhouse Design -->
        <div class="course-section">
               <div class="section-header" onclick="toggleSection('section2')">
        Section 2: Greenhouses Design
    </div>
    <div class="section-content" id="section2">
        <div class="subsection">
            <h3 class="subsection-title">2.1 Basics of Greenhouse Gardening</h3>
            <button class="btn" onclick="toggleVideo('video2_1_container')">Video 1: What is a Greenhouse?</button>
            <div class="video-container" id="video2_1_container" style="display: none;">
                <p class="video-description">An overview of greenhouses and their purposes.</p>
                <video id="player2_1" playsinline controls>
                    <source src="greenhouse_intro.mp4" type="video/mp4" />
                </video>
            </div>

            <button class="btn" onclick="toggleVideo('video2_2_container')">Video 2: Benefits of Greenhouse Cultivation</button>
            <div class="video-container" id="video2_2_container" style="display: none;">
                <p class="video-description">Explore the advantages of growing plants in a controlled environment.</p>
                <video id="player2_2" playsinline controls>
                    <source src="greenhouse_benefits.mp4" type="video/mp4" />
                </video>
            </div>
        </div>
            <div class="file-upload-section">
    <h3>Task: Greenhouse Climate Control Plan</h3>
    <p>Develop a basic climate control plan for your greenhouse. Consider factors such as temperature regulation, humidity control, and air circulation. Create a document outlining your plan and upload it as a PDF file.</p>
    
    <!-- Download Sample File Button -->
    <div class="sample-file-container">
        <a href="sample-plan.pdf" download>
            <button class="btn">Download Sample File</button>
        </a>
    </div>

        <!-- Download Sample File Button -->
    <div class="sample-file-container">
        <a href="sample-plan.pdf" download>
            <button class="btn">Download Sample File</button>
        </a>
    </div>
    
    <div class="file-input-container">
        <label for="file-upload-2" class="file-input-label">Choose File</label>
        <input type="file" id="file-upload-2" accept=".pdf" onchange="displayFileName(this, 'file-name-display-2')">
    </div>
    <div id="file-name-display-2" class="file-name-display"></div>
    <button class="upload-button" onclick="uploadFile('file-upload-2', '2')">Upload Plan</button>
     <div id="uploaded-file-2" class="uploaded-file"></div>
</div>

        <div class="subsection">
            <h3 class="subsection-title">2.2 Types of Greenhouses</h3>
            <button class="btn" onclick="toggleVideo('video2_3_container')">Video 3: Common Greenhouse Structures</button>
            <div class="video-container" id="video2_3_container" style="display: none;">
                <p class="video-description">Learn about different types of greenhouse designs and their uses.</p>
                <video id="player2_3" playsinline controls>
                    <source src="greenhouse_types.mp4" type="video/mp4" />
                </video>
            </div>
        </div>

    <button class="btn" onclick="showQuiz('quiz2')">Attempt Quiz</button>
    <div class="quiz" id="quiz2" style="display: none;">
    <form onsubmit="return checkQuiz('quiz2')">
        <!-- Question 1 -->
        <div class="quiz-question">
            <p>1. What is the purpose of providing adequate water to plants?</p>
            <label>
                <input type="radio" name="q1" value="correct"> a) Optimal plant growth
            </label>
            <label>
                <input type="radio" name="q1" value="incorrect"> b) Reducing plant growth
            </label>
            <label>
                <input type="radio" name="q1" value="incorrect"> c) Increasing plant stress
            </label>
        </div>

        <!-- Question 2 -->
        <div class="quiz-question">
            <p>2. What is the impact of proper soil pH on plant health?</p>
            <label>
                <input type="radio" name="q2" value="incorrect"> a) Decreases nutrient absorption
            </label>
            <label>
                <input type="radio" name="q2" value="correct"> b) Enhances nutrient availability
            </label>
            <label>
                <input type="radio" name="q2" value="incorrect"> c) Causes root damage
            </label>
        </div>

        <!-- Add more questions here if needed -->

        <button type="submit" class="btn">Submit Quiz</button>
    </form>


    <div class="error-message" id="error-message-quiz2">You need at least 75% to pass this quiz.</div>
    <div class="success-message" id="success-message-quiz2">Congratulations! You've passed the quiz.</div>

        
    </div>
</div>
</div>

        <!-- Section 3: Construction -->
<div class="course-section">
    <div class="section-header" onclick="toggleSection('section3')">
        Section 3: Greenhouses Construction
    </div>
    <div class="section-content" id="section3">
        <div class="subsection">
            <h3 class="subsection-title">3.1 Basics of Greenhouse Gardening</h3>
            <button class="btn" onclick="toggleVideo('video3_1_container')">Video 1: What is a Greenhouse?</button>
            <div class="video-container" id="video3_1_container" style="display: none;">
                <p class="video-description">An overview of greenhouses and their purposes.</p>
                <video id="player3_1" playsinline controls>
                    <source src="greenhouse_intro.mp4" type="video/mp4" />
                </video>
            </div>

            <button class="btn" onclick="toggleVideo('video3_2_container')">Video 2: Benefits of Greenhouse Cultivation</button>
            <div class="video-container" id="video3_2_container" style="display: none;">
                <p class="video-description">Explore the advantages of growing plants in a controlled environment.</p>
                <video id="player3_2" playsinline controls>
                    <source src="greenhouse_benefits.mp4" type="video/mp4" />
                </video>
            </div>
        </div>

        <div class="subsection">
            <h3 class="subsection-title">3.2 Types of Greenhouses</h3>
            <button class="btn" onclick="toggleVideo('video3_3_container')">Video 3: Common Greenhouse Structures</button>
            <div class="video-container" id="video3_3_container" style="display: none;">
                <p class="video-description">Learn about different types of greenhouse designs and their uses.</p>
                <video id="player3_3" playsinline controls>
                    <source src="greenhouse_types.mp4" type="video/mp4" />
                </video>
            </div>
        </div>
         <div class="file-upload-section">
    <h3>Task: Greenhouse Climate Control Plan</h3>
    <p>Develop a basic climate control plan for your greenhouse. Consider factors such as temperature regulation, humidity control, and air circulation. Create a document outlining your plan and upload it as a PDF file.</p>
    
    <!-- Download Sample File Button -->
    <div class="sample-file-container">
        <a href="sample-plan.pdf" download>
            <button class="btn">Download Sample File</button>
        </a>
    </div>

        <!-- Download Sample File Button -->
    <div class="sample-file-container">
        <a href="sample-plan.pdf" download>
            <button class="btn">Download Sample File</button>
        </a>
    </div>
    
    <div class="file-input-container">
        <label for="file-upload-4" class="file-input-label">Choose File</label>
        <input type="file" id="file-upload-4" accept=".pdf" onchange="displayFileName(this, 'file-name-display-3')">
    </div>
    <div id="file-name-display-3" class="file-name-display"></div>
    <button class="upload-button" onclick="uploadFile('file-upload-4', '3')">Upload Plan</button>
     <div id="uploaded-file-3" class="uploaded-file"></div>
</div>

        <button class="btn" onclick="showQuiz('quiz3')">Attempt Quiz</button>
        <div class="quiz" id="quiz3" style="display: none;">
            <form onsubmit="return checkQuiz('quiz3')">
                <!-- Question 1 -->
                <div class="quiz-question">
                    <p>1. What is the primary purpose of a greenhouse?</p>
                    <label>
                        <input type="radio" name="q1" value="correct"> a) To grow plants
                    </label>
                    <label>
                        <input type="radio" name="q1" value="incorrect"> b) To store tools
                    </label>
                    <label>
                        <input type="radio" name="q1" value="incorrect"> c) To raise fish
                    </label>
                </div>

                <!-- Question 2 -->
                <div class="quiz-question">
                    <p>2. What is the best way to increase soil fertility?</p>
                    <label>
                        <input type="radio" name="q2" value="incorrect"> a) Using synthetic pesticides
                    </label>
                    <label>
                        <input type="radio" name="q2" value="correct"> b) Adding organic compost
                    </label>
                    <label>
                        <input type="radio" name="q2" value="incorrect"> c) Using excess water
                    </label>
                </div>

                <button type="submit" class="btn">Submit Quiz</button>
            </form>
            <div class="error-message" id="error-message-quiz3">You need at least 75% to pass this quiz.</div>
            <div class="success-message" id="success-message-quiz3">Congratulations! You've passed the quiz.</div>
        </div>
    </div>
</div>




        <!-- Section 4: Greenhouse cost -->
        <div class="course-section">
               <div class="section-header" onclick="toggleSection('section4')">
        Section 4: Greenhouse cost
    </div>
    <div class="section-content" id="section4">
        <div class="subsection">
            <h3 class="subsection-title">4.1 Basics of Greenhouse Gardening</h3>
            <button class="btn" onclick="toggleVideo('video4_1_container')">Video 1: What is a Greenhouse?</button>
            <div class="video-container" id="video4_1_container" style="display: none;">
                <p class="video-description">An overview of greenhouses and their purposes.</p>
                <video id="player4_1" playsinline controls>
                    <source src="greenhouse_intro.mp4" type="video/mp4" />
                </video>
            </div>

            <button class="btn" onclick="toggleVideo('video4_2_container')">Video 2: Benefits of Greenhouse Cultivation</button>
            <div class="video-container" id="video4_2_container" style="display: none;">
                <p class="video-description">Explore the advantages of growing plants in a controlled environment.</p>
                <video id="player4_2" playsinline controls>
                    <source src="greenhouse_benefits.mp4" type="video/mp4" />
                </video>
            </div>
        </div>

        <div class="subsection">
            <h3 class="subsection-title">4.2 Types of Greenhouses</h3>
            <button class="btn" onclick="toggleVideo('video4_3_container')">Video 3: Common Greenhouse Structures</button>
            <div class="video-container" id="video4_3_container" style="display: none;">
                <p class="video-description">Learn about different types of greenhouse designs and their uses.</p>
                <video id="player4_3" playsinline controls>
                    <source src="greenhouse_types.mp4" type="video/mp4" />
                </video>
            </div>
        </div>
<div class="file-upload-section">
    <h3>Task: Greenhouse Climate Control Plan</h3>
    <p>Develop a basic climate control plan for your greenhouse. Consider factors such as temperature regulation, humidity control, and air circulation. Create a document outlining your plan and upload it as a PDF file.</p>
    
    <!-- Download Sample File Button -->
    <div class="sample-file-container">
        <div class="custom-dropdown">
            <div class="selected-option" onclick="toggleDropdown()">Select a sample file</div>
            <div class="options" id="dropdown-options">
                <div class="option" onclick="selectOption('sample-plan-1.pdf', 'Sample Plan 1')">Sample Plan 1</div>
                <div class="option" onclick="selectOption('sample-plan-2.pdf', 'Sample Plan 2')">Sample Plan 2</div>
                <div class="option" onclick="selectOption('sample-plan-3.pdf', 'Sample Plan 3')">Sample Plan 3</div>
            </div>
        </div>
        <button class="btn" onclick="downloadSampleFile()">Download Sample File</button>
    </div>
    <div id="error-message" class="error-message"></div>

       <div class="file-input-container">
        <label for="file-upload-4" class="file-input-label">Choose File</label>
        <input type="file" id="file-upload-4" accept=".pdf" onchange="displayFileName(this, 'file-name-display-4')">
    </div>
    <div id="file-name-display-4" class="file-name-display"></div>
    <button class="upload-button" onclick="uploadFile('file-upload-4', '4')">Upload Plan</button>
     <div id="uploaded-file-4" class="uploaded-file"></div>
</div>

    <button class="btn" onclick="showQuiz('quiz4')">Attempt Quiz</button>
    <div class="quiz" id="quiz4" style="display: none;">
    <form onsubmit="return checkQuiz('quiz4')">
        <!-- Question 1 -->
        <div class="quiz-question">
            <p>1. What is the purpose of providing adequate water to plants?</p>
            <label>
                <input type="radio" name="q1" value="correct"> a) Optimal plant growth
            </label>
            <label>
                <input type="radio" name="q1" value="incorrect"> b) Reducing plant growth
            </label>
            <label>
                <input type="radio" name="q1" value="incorrect"> c) Increasing plant stress
            </label>
        </div>

        <!-- Question 2 -->
        <div class="quiz-question">
            <p>2. What is the impact of proper soil pH on plant health?</p>
            <label>
                <input type="radio" name="q2" value="incorrect"> a) Decreases nutrient absorption
            </label>
            <label>
                <input type="radio" name="q2" value="correct"> b) Enhances nutrient availability
            </label>
            <label>
                <input type="radio" name="q2" value="incorrect"> c) Causes root damage
            </label>
        </div>

        <!-- Add more questions here if needed -->

        <button type="submit" class="btn">Submit Quiz</button>
    </form>
   
    <div class="error-message" id="error-message-quiz4">You need at least 75% to pass this quiz.</div>
    <div class="success-message" id="success-message-quiz4">Congratulations! You've passed the quiz.</div>
</div>

            </div>
        </div>

        <div id="completion-message">
            <p>Congratulations! You've completed the Greenhouses Course.</p>
        </div>
    </div>
    <div id="notification-badge-container"></div>

    <canvas id="confetti-canvas"></canvas>

   <footer>


        <div class="container">
            <div class="footer-content">
                <div class="footer-section">
                    <h3>About CropSync</h3>
                    <p>CropSync is dedicated to revolutionizing agriculture through innovative technology and research.</p>
                </div>
                <div class="footer-section">
                    <h3>Quick Links</h3>
                    <ul>
                        <li><a href="index.php">Home</a></li>
                        <li><a href="index.php">Services</a></li>
                        <li><a href="index.php">Our Work</a></li>
                        <li><a href="privacy.php">Privacy Policy</a></li>
                    </ul>
                </div>
                <div class="footer-section">
                    <h3>Connect With Us</h3>
                    <div class="social-icons">
                        <a href="https://www.facebook.com/profile.php?id=61566437559561&mibextid=ZbWKwL"><i class="fab fa-facebook"></i></a>
                        <a href="https://x.com/CropSync365?t=huB6RVyHezmBQJZcyPTegg&s=09"><i class="fab fa-twitter"></i></a>
                        <a href="https://www.linkedin.com/company/cropsync/"><i class="fab fa-linkedin"></i></a>
                        <a href="https://www.instagram.com/cropsync_official/"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; 2024 CropSync. All rights reserved. | Made with ❤️ by CropSync Team</p>
            </div>
        </div>
        </footer>

    <script>
// Initialize Plyr for video players
const players = Plyr.setup('.video-container video');

// Keep track of open sections and subsections
let openSection = null;
let openSubsection = null;

// Toggle section visibility
function toggleSection(sectionId) {
    const section = document.getElementById(sectionId);
    if (openSection && openSection !== section) {
        openSection.style.display = 'none';
    }
    if (section.style.display === 'none' || section.style.display === '') {
        section.style.display = 'block';
        openSection = section;
    } else {
        section.style.display = 'none';
        openSection = null;
    }
}

// Toggle video visibility
function toggleVideo(videoId) {
    const video = document.getElementById(videoId);
    if (openSubsection && openSubsection !== video) {
        openSubsection.style.display = 'none';
    }
    if (video.style.display === 'none' || video.style.display === '') {
        video.style.display = 'block';
        openSubsection = video;
    } else {
        video.style.display = 'none';
        openSubsection = null;
    }
}

// Show quiz
function showQuiz(quizId) {
    const quiz = document.getElementById(quizId);
    quiz.style.display = 'block';
}

// Check quiz answers
function checkQuiz(quizId) {
    const form = document.querySelector(`#${quizId} form`);
    const questions = form.querySelectorAll('.quiz-question');
    let correctAnswers = 0;

    questions.forEach(question => {
        const selectedAnswer = question.querySelector('input:checked');
        if (selectedAnswer && selectedAnswer.value === 'correct') {
            correctAnswers++;
        }
    });

    const percentage = (correctAnswers / questions.length) * 100;
    const errorMessage = document.getElementById(`error-message-${quizId}`);
    const successMessage = document.getElementById(`success-message-${quizId}`);

    if (percentage >= 75) {
        errorMessage.style.display = 'none';
        successMessage.style.display = 'block';
        updateProgress(quizId, true);
    } else {
        errorMessage.style.display = 'block';
        successMessage.style.display = 'none';
    }

    return false; // Prevent form submission
}

 function updateProgress(quizId, completed) {
            const xhr = new XMLHttpRequest();
            xhr.open('POST', '', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    const response = JSON.parse(xhr.responseText);
                    if (response.success) {
                        const progressBar = document.getElementById('progress-bar');
                        const progressPercentage = document.getElementById('progress-percentage');
                        const newProgress = calculateNewProgress(completed);
                        progressBar.style.width = newProgress + '%';
                        progressPercentage.textContent = newProgress.toFixed(2) + '%';
                        if (newProgress === 100) {
                            document.getElementById('completion-message').style.display = 'block';
                            triggerConfetti();
                        }
                    } else {
                        alert('Failed to update progress. Please try again.');
                    }
                }
            };
            xhr.send('action=updateProgress&quizId=' + quizId + '&completed=' + completed);
        }

        function calculateNewProgress(completed) {
            const progressBar = document.getElementById('progress-bar');
            const currentWidth = parseFloat(progressBar.style.width) || 0;
            const increment = 100 / <?php echo $totalQuizzes; ?>;
            return completed ? Math.min(currentWidth + increment, 100) : currentWidth;
        }


function showCompletionMessage() {
    const completionMessage = document.getElementById('completion-message');
    completionMessage.style.display = 'block';
    triggerConfetti();
}

// Trigger confetti animation
function triggerConfetti() {
    const canvas = document.getElementById('confetti-canvas');
    const myConfetti = confetti.create(canvas, {
        resize: true,
        useWorker: true
    });
    myConfetti({
        particleCount: 100,
        spread: 160,
        origin: { y: 0.6 }
    });
}

let selectedFile = '';

function toggleDropdown() {
    const options = document.getElementById('dropdown-options');
    options.style.display = options.style.display === 'block' ? 'none' : 'block';
}

function selectOption(value, text) {
    selectedFile = value;
    document.querySelector('.selected-option').textContent = text;
    toggleDropdown();

     // Remove error message when a file is selected
    const errorMessage = document.getElementById("error-message");
    errorMessage.style.display = "none";
}


function downloadSampleFile() {
    const errorMessage = document.getElementById("error-message");
    
    if (selectedFile) {
        errorMessage.style.display = "none";
        const link = document.createElement('a');
        link.href = selectedFile;
        link.download = selectedFile;
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
    } else {
        errorMessage.textContent = "Please select a sample file before downloading.";
        errorMessage.style.display = "block";
    }
}

document.addEventListener('click', function(event) {
    const dropdown = document.querySelector('.custom-dropdown');
    const options = document.getElementById('dropdown-options');
    if (!dropdown.contains(event.target)) {
        options.style.display = 'none';
    }
});
// Display file name when selected
function displayFileName(input, displayId) {
    const fileName = input.files[0].name;
    document.getElementById(displayId).textContent = fileName;
}

function showNotification(message, type = 'success') {
    const notificationContainer = document.getElementById('notification-badge-container');
    const notification = document.createElement('div');
    notification.className = `notification-badge ${type}`;
    notification.innerText = message;

    notificationContainer.appendChild(notification);

    // Show the notification
    setTimeout(() => {
        notification.style.opacity = 1;
    }, 10);

    // Hide and remove the notification after 3 seconds
    setTimeout(() => {
        notification.style.opacity = 0;
        setTimeout(() => {
            notification.remove();
        }, 500); // Wait for the transition to complete
    }, 3000);
}

function uploadFile(inputId, quizId) {
    console.log('uploadFile called with quizId:', quizId); // Debug log

    const fileInput = document.getElementById(inputId);
    const file = fileInput.files[0];
    if (!file) {
        showNotification('Please select a file to upload.', 'error');
        return;
    }

    const formData = new FormData();
    formData.append('file', file);
    formData.append('quizId', quizId);

    console.log('FormData contents:'); // Debug log
    for (let pair of formData.entries()) {
        console.log(pair[0] + ': ' + pair[1]);
    }

    const xhr = new XMLHttpRequest();
    xhr.open('POST', 'upload_file.php', true);

    xhr.onload = function() {
        console.log('XHR response:', this.responseText);
        console.log('XHR status:', this.status);

        if (this.status === 200) {
            try {
                const response = JSON.parse(this.responseText);
                if (response.success) {
                    showNotification('File uploaded successfully!', 'success');
                    displayUploadedFile(quizId, response.filePath);
                    if (typeof updateProgress === 'function') {
                        updateProgress(quizId, true);
                    } else {
                        console.error('updateProgress function is not defined');
                    }
                } else {
                    showNotification('Error uploading file: ' + (response.message || 'Unknown error'), 'error');
                }
            } catch (e) {
                console.error('Error parsing JSON response:', e);
                console.error('Raw response:', this.responseText);
                showNotification('Unexpected server response. Check the console for details.', 'error');
            }
        } else {
            console.error('Server error:', this.status, this.responseText);
            showNotification('Server error: ' + this.status + '\nPlease check the console for details.', 'error');
        }
    };

    xhr.onerror = function() {
        console.error('Network error occurred');
        showNotification('Network error occurred. Please try again later.', 'error');
    };

    xhr.send(formData);
}

function displayUploadedFile(quizId, filePath) {
    const fileDisplay = document.getElementById(`uploaded-file-${quizId}`);
    const fileName = filePath.split('/').pop();
    fileDisplay.innerHTML = `
        <p>Uploaded file: ${fileName}</p>
        <a href="${filePath}" target="_blank">View File</a>
    `;
}

function loadUploadedFile(quizId) {
    const xhr = new XMLHttpRequest();
    xhr.open('GET', `upload_file.php?quizId=${quizId}`, true);
    xhr.onload = function() {
        if (this.status === 200) {
            try {
                const response = JSON.parse(this.responseText);
                if (response.success) {
                    displayUploadedFile(quizId, response.filePath);
                }
            } catch (e) {
                console.error('Error parsing JSON response:', e);
            }
        }
    };
    xhr.send();
}

// Call this function when the page loads
document.addEventListener('DOMContentLoaded', function() {
    loadUploadedFile('2');
    loadUploadedFile('3'); 
    loadUploadedFile('4'); 
});


$(document).on('click', '.btn-dismiss', function() {
    var notificationId = $(this).closest('li').data('id');
    // Fade out the notification immediately
    $('li[data-id="' + notificationId + '"]').fadeOut(function() {
        $(this).remove(); // Remove from DOM after fading out
        // Check if there are no more notifications
        if ($('#notification-list li').length === 0) {
            $('.notifications').html('<h3>Unread Notifications</h3><p>No unread notifications.</p>');
        }
    });
    dismissNotification(notificationId); // Call AJAX function after fading out
});

function dismissNotification(notificationId) {
    $.ajax({
        url: 'greenhouse_course.php',
        type: 'POST',
        data: {
            action: 'markNotificationAsRead',
            notificationId: notificationId
        },
        success: function(response) {
            console.log(response); // For debugging
            var data = JSON.parse(response);
            if (!data.success) {
                alert('Error marking notification as read.');
                // Optionally, you can undo the fade out here if needed
                // $('li[data-id="' + notificationId + '"]').fadeIn();
            }
        },
        error: function() {
            alert('An error occurred while processing your request.');
            // Optionally, you can undo the fade out here if needed
            // $('li[data-id="' + notificationId + '"]').fadeIn();
        }
    });
}

    </script>
   <!-- jQuery (full version) -->

<!-- Popper.js -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>

<!-- Bootstrap -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>