<?php
session_start();
include '../includes/db_connect.php';
include '../includes/navbar.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

// Book Count
$bookResult = $conn->query("SELECT COUNT(*) as total_books FROM books");
$books = $bookResult->fetch_assoc()['total_books'];

// User Count
$userResult = $conn->query("SELECT COUNT(*) as total_users FROM users WHERE role = 'patron'");
$users = $userResult->fetch_assoc()['total_users'];

// Borrowed Books
$borrowedResult = $conn->query("SELECT COUNT(*) as borrowed FROM transactions WHERE return_date IS NULL");
$borrowed = $borrowedResult->fetch_assoc()['borrowed'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Admin Dashboard - Libro</title>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/FinalProject/assets/css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

</head>
<body class="bg-light">

<div class="container py-5">
    <h2 class="mb-4 text-center fw-bold">📘 Welcome, Admin <?= $_SESSION['name'] ?>!</h2>

    <div class="row g-4 justify-content-center">
        <!-- Total Books -->
        <div class="col-md-4">
            <div class="card text-center shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">📚 Total Books</h5>
                    <p class="display-6 fw-bold"><?= $books ?></p>
                    <a href="admin_manage_books.php" class="btn btn-primary w-100">Manage Books</a>
                    </div>
            </div>
        </div>

        <!-- Total Users -->
        <div class="col-md-4">
            <div class="card text-center shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">👥 Total Users</h5>
                    <p class="display-6 fw-bold"><?= $users ?></p>
                    <a href="manage_users.php" class="btn btn-outline-secondary w-100">View Users</a>
                </div>
            </div>
        </div>

        <!-- Borrowed Books -->
        <div class="col-md-4">
            <div class="card text-center shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">🔄 Borrowed Books</h5>
                    <p class="display-6 fw-bold"><?= $borrowed ?></p>
                    <a href="borrowed_books.php" class="btn btn-outline-danger w-100">View Borrowed</a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include '../includes/footer.php'; ?>

</body>
</html>
