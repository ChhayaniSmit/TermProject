<?php
session_start();
include '../includes/db_connect.php';
// 1. Get current user's ID
$user_id = $_SESSION['user_id'];

// 2. Count how many books they currently have (not returned)
$checkSql = "SELECT COUNT(*) as count FROM transactions WHERE user_id = ? AND return_date IS NULL";
$stmt = $conn->prepare($checkSql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

if ($row['count'] >= 2) {
    // User already borrowed 2 books
    header("Location: books.php?limit=1");
exit();

}

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'patron') {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['book_id'])) {
    $user_id = $_SESSION['user_id'];
    $book_id = $_POST['book_id'];
    $issue_date = date('Y-m-d');

    // 1. Insert into transactions table
    $sql = "INSERT INTO transactions (user_id, book_id, issue_date) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iis", $user_id, $book_id, $issue_date);
    $stmt->execute();

    // 2. Update book status to 'borrowed'
    $update = "UPDATE books SET status = 'borrowed' WHERE book_id = ?";
    $stmt2 = $conn->prepare($update);
    $stmt2->bind_param("i", $book_id);
    $stmt2->execute();

    echo "<script>alert('Book borrowed successfully!'); window.location='user_dashboard.php';</script>";
}
?>
