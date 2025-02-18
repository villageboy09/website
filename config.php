<?php
$servername = "sql305.infinityfree.com";
$username = "if0_36528819";
$password = "JLXnIWb6yBKw3H0";
$dbname = "if0_36528819_contact_form";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>