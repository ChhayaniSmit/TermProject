<?php
session_start();
include '../includes/db_connect.php';

// Ensure only admin can access
if ($_SESSION['role'] !== 'admin') {
    header("Location: user_dashboard.php");
    exit();
}

if (isset($_GET['id'])) {
    $book_id = $_GET['id'];
    $sql = "DELETE FROM books WHERE book_id = $book_id";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Book deleted successfully!'); window.location='admin_dashboard.php';</script>";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>
