<?php
session_start();
include '../includes/db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['transaction_id'])) {
    $transaction_id = $_POST['transaction_id'];

    // 1. Set return_date
    $stmt = $conn->prepare("UPDATE transactions SET return_date = NOW() WHERE transaction_id = ?");
    $stmt->bind_param("i", $transaction_id);
    $stmt->execute();

    // 2. Update book status
    $book_id = $_POST['book_id'];
    $stmt2 = $conn->prepare("UPDATE books SET status = 'available' WHERE book_id = ?");
    $stmt2->bind_param("i", $book_id);
    $stmt2->execute();
}

header("Location: user_dashboard.php");
exit();
