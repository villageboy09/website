<?php
// submit_request.php

// Start session if needed
session_start();

// Database connection
$servername = "sql305.infinityfree.com";
$username = "if0_36528819";
$password = "JLXnIWb6yBKw3H0";
$dbname = "if0_36528819_contact_form";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare and bind
$stmt = $conn->prepare("INSERT INTO requests (name, email, mobile, course) VALUES (?, ?, ?, ?)");
if (!$stmt) {
    echo "Database error: " . $conn->error;
    exit();
}

// Sanitize and validate input
$name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
$email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
$mobile = filter_var($_POST['mobile'], FILTER_SANITIZE_STRING);
$course = filter_var($_POST['course'], FILTER_SANITIZE_STRING);

if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
    echo "Invalid email format";
    exit();
}

$stmt->bind_param("ssss", $name, $email, $mobile, $course);

// Execute the statement
if ($stmt->execute()) {
    echo "Request submitted successfully";
} else {
    echo "Error: " . $stmt->error;
}

// Close statement and connection
$stmt->close();
$conn->close();
?>
