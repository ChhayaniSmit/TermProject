<?php
$host = "localhost";
$user = "root"; // Default user for XAMPP
$password = ""; // No password for XAMPP by default
$dbname = "library_db"; // Your database name

// Create connection
$conn = new mysqli($host, $user, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
