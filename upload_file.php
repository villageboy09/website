<?php
session_start();
include 'config.php';

// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Function to log errors and debug info
function logMessage($message) {
    error_log(date('[Y-m-d H:i:s] ') . $message . "\n", 3, 'debug.log');
}

logMessage('POST data: ' . print_r($_POST, true)); // Debug log
logMessage('FILES data: ' . print_r($_FILES, true)); // Debug log

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['file'])) {
    try {
        if (!isset($_SESSION['user_id'])) {
            throw new Exception('User is not logged in.');
        }
        $userId = $_SESSION['user_id'];
        
        // Check if quizId is set and not empty
        if (!isset($_POST['quizId']) || empty($_POST['quizId'])) {
            throw new Exception('Quiz ID is missing or invalid.');
        }
        $quizId = (int)$_POST['quizId']; // Cast to integer
        
        logMessage("Received quizId: " . $quizId); // Debug log
        
        $file = $_FILES['file'];

        // Define upload directory
        $uploadDir = 'course_uploads/';
        if (!file_exists($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }


        // Use the original file name, but ensure it's unique
        $fileName = $file['name'];
        $fileNameParts = pathinfo($fileName);
        $fileExtension = $fileNameParts['extension'];
        $fileNameWithoutExt = $fileNameParts['filename'];
        $counter = 1;

        while (file_exists($uploadDir . $fileName)) {
            $fileName = $fileNameWithoutExt . '_' . $counter . '.' . $fileExtension;
            $counter++;
        }

        $targetPath = $uploadDir . $fileName;

// Check file type (allow PDF, Excel, and video files)
$allowedTypes = [
    'application/pdf',
    'application/vnd.ms-excel',
    'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
    'video/mp4',
    'video/mpeg',
    'video/quicktime',
    'video/x-msvideo'
];

$finfo = finfo_open(FILEINFO_MIME_TYPE);
$mimeType = finfo_file($finfo, $file['tmp_name']);
finfo_close($finfo);

if (!in_array($mimeType, $allowedTypes)) {
    throw new Exception('Only PDF, Excel, and video files are allowed.');
}

// Check file size (limit to 50MB)
$maxFileSize = 50 * 1024 * 1024; // 50MB in bytes
if ($file['size'] > $maxFileSize) {
    throw new Exception('File size exceeds the limit of 50MB.');
}

        // Move uploaded file to target directory
        if (!move_uploaded_file($file['tmp_name'], $targetPath)) {
            throw new Exception('Error moving uploaded file.');
        }

        // Check if a file already exists for this user and quiz
        $checkStmt = $conn->prepare("SELECT file_path FROM user_uploads WHERE user_id = ? AND quiz_id = ?");
        $checkStmt->bind_param("ii", $userId, $quizId);
        $checkStmt->execute();
        $result = $checkStmt->get_result();

        if ($result->num_rows > 0) {
            // File exists, update the record
            $oldFile = $result->fetch_assoc()['file_path'];
            if (file_exists($oldFile)) {
                unlink($oldFile); // Delete the old file
            }
            $updateStmt = $conn->prepare("UPDATE user_uploads SET file_name = ?, file_path = ?, upload_date = NOW() WHERE user_id = ? AND quiz_id = ?");
            $updateStmt->bind_param("ssii", $file['name'], $targetPath, $userId, $quizId);
            $updateStmt->execute();
            $updateStmt->close();
        } else {
            // No existing file, insert new record
            $insertStmt = $conn->prepare("INSERT INTO user_uploads (user_id, quiz_id, file_name, file_path, upload_date) VALUES (?, ?, ?, ?, NOW())");
            $insertStmt->bind_param("iiss", $userId, $quizId, $file['name'], $targetPath);
            $insertStmt->execute();
            $insertStmt->close();
        }

        $checkStmt->close();

        // Update user progress for this quiz
        $updateStmt = $conn->prepare("INSERT INTO user_progress (user_id, quiz_id, completed, completion_date)
            VALUES (?, ?, 1, NOW())
            ON DUPLICATE KEY UPDATE completed = 1, completion_date = NOW()");
        if (!$updateStmt) {
            throw new Exception('Prepare failed for update: ' . $conn->error);
        }

        $updateStmt->bind_param("ii", $userId, $quizId);
        if (!$updateStmt->execute()) {
            throw new Exception('Execute failed for update: ' . $updateStmt->error);
        }

        $updateStmt->close();
        $conn->close();

        echo json_encode(['success' => true, 'message' => 'File uploaded successfully and progress updated.', 'filePath' => $targetPath]);
    } catch (Exception $e) {
        logMessage('Error: ' . $e->getMessage());
        http_response_code(500);
        echo json_encode(['success' => false, 'message' => 'An error occurred: ' . $e->getMessage()]);
    }
} else if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['quizId'])) {
    // Handle GET request to retrieve the uploaded file info
    $userId = $_SESSION['user_id'];
    $quizId = (int)$_GET['quizId'];

    $stmt = $conn->prepare("SELECT file_name, file_path FROM user_uploads WHERE user_id = ? AND quiz_id = ?");
    $stmt->bind_param("ii", $userId, $quizId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        echo json_encode(['success' => true, 'fileName' => $row['file_name'], 'filePath' => $row['file_path']]);
    } else {
        echo json_encode(['success' => false, 'message' => 'No file found']);
    }
    $stmt->close();
} else {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Invalid request']);
}
?>