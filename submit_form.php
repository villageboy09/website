<?php
$servername = "sql305.infinityfree.com";
$username = "if0_36528819";
$password = "JLXnIWb6yBKw3H0";
$dbname = "if0_36528819_applications";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    echo json_encode(['status' => 'error', 'message' => 'Connection failed: ' . $conn->connect_error]);
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Common fields
    $name = $_POST['name'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];
    $state = $_POST['state'];
    $role = $_POST['role'];
    $ai_tools = $_POST['ai_tools'];
    $technical_proficiency = $_POST['technical_proficiency'];
    $resume = $_FILES['resume'];

    // Role-specific fields
    $field_challenge = isset($_POST['field_challenge']) ? $_POST['field_challenge'] : '';
    $community_engagement = isset($_POST['community_engagement']) ? $_POST['community_engagement'] : '';
    $content_creation = isset($_POST['content_creation']) ? $_POST['content_creation'] : '';
    $trend_awareness = isset($_POST['trend_awareness']) ? $_POST['trend_awareness'] : '';
    $instagram_profile = isset($_POST['instagram_profile']) ? $_POST['instagram_profile'] : '';
    $financial_analysis = isset($_POST['financial_analysis']) ? $_POST['financial_analysis'] : '';
    $accuracy_reporting = isset($_POST['accuracy_reporting']) ? $_POST['accuracy_reporting'] : '';

    // Handle file upload
    $target_dir = "upload/";
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0755, true); // Create directory if it does not exist
    }
    $target_file = $target_dir . basename($resume["name"]);
    $uploadOk = 1;
    $fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check file size
    if ($resume["size"] > 5000000) {
        echo json_encode(['status' => 'error', 'message' => 'Sorry, your file is too large.']);
        $uploadOk = 0;
    }

    // Allow certain file formats
    if ($fileType != "pdf" && $fileType != "doc" && $fileType != "docx") {
        echo json_encode(['status' => 'error', 'message' => 'Sorry, only PDF, DOC & DOCX files are allowed.']);
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo json_encode(['status' => 'error', 'message' => 'Sorry, your file was not uploaded.']);
    } else {
        if (move_uploaded_file($resume["tmp_name"], $target_file)) {
            // Construct the file URL
            $file_url = "https://cropsync.online/" . $target_file; // Change to your actual domain

            // Store form data and file URL in the database
            $sql = "INSERT INTO interns (name, email, contact, state, role, ai_tools, technical_proficiency, resume_url, 
                    field_challenge, community_engagement, content_creation, trend_awareness, instagram_profile, 
                    financial_analysis, accuracy_reporting) 
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            
            if ($stmt = $conn->prepare($sql)) {
                $stmt->bind_param("sssssssssssssss", $name, $email, $contact, $state, $role, $ai_tools, $technical_proficiency, 
                                   $file_url, $field_challenge, $community_engagement, $content_creation, $trend_awareness, 
                                   $instagram_profile, $financial_analysis, $accuracy_reporting);

                if ($stmt->execute()) {
                    echo json_encode(['status' => 'success']);
                } else {
                    echo json_encode(['status' => 'error', 'message' => 'Database error: ' . $stmt->error]);
                }
                $stmt->close();
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Database prepare error: ' . $conn->error]);
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Sorry, there was an error uploading your file.']);
        }
    }
}

$conn->close();
?>
