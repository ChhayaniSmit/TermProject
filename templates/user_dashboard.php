<?php
session_start();
include '../includes/db_connect.php';
include '../includes/navbar.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'patron') {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Get borrowed count
$countQuery = "SELECT COUNT(*) as total FROM transactions WHERE user_id = $user_id AND return_date IS NULL";
$result = $conn->query($countQuery);
$data = $result->fetch_assoc();
$borrowedCount = $data['total'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>User Dashboard - Libro</title>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/FinalProject/assets/css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

</head>
<body class="bg-light">

<div class="container py-5">
    <h2 class="mb-4 text-center fw-bold">📘 Welcome, <?= $_SESSION['name'] ?>!</h2>

    <div class="row g-4 justify-content-center">
        <!-- Borrowed Books Count -->
        <div class="col-md-6 col-lg-4">
            <div class="card text-center shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">📚 Books Borrowed</h5>
                    <p class="display-6 fw-bold"><?= $borrowedCount ?></p>
                    <a href="books.php" class="btn btn-primary w-100">Browse Books</a>
                </div>
            </div>
        </div>

        <!-- Profile Info -->
        <div class="col-md-6 col-lg-4">
            <div class="card shadow-sm text-center">
                <div class="card-body">
                    <h5 class="card-title"><i class="fas fa-user-circle"></i> My Profile</h5>
                    <p class="mb-1"><?= $_SESSION['name'] ?></p>
                    <p class="mb-1 text-muted"><?= $_SESSION['email'] ?></p>
                    <a href="profile.php" class="btn btn-outline-secondary w-100">View Profile</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Borrowed Book List -->
    <div class="mt-5">
        <h4 class="mb-3">🔁 My Borrowed Books</h4>

        <?php
        $sql = "SELECT t.transaction_id, t.book_id, b.title, b.author, b.category
                FROM transactions t
                JOIN books b ON t.book_id = b.book_id
                WHERE t.user_id = ? AND t.return_date IS NULL";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        ?>

        <?php if ($result->num_rows > 0): ?>
            <div class="list-group shadow-sm">
                <?php while ($book = $result->fetch_assoc()): ?>
                    <div class="list-group-item d-flex justify-content-between align-items-center">
                        <div>
                            <strong><?= $book['title'] ?></strong><br>
                            <small class="text-muted"><?= $book['author'] ?> | <?= $book['category'] ?></small>
                        </div>
                        <div class="d-flex gap-2">
                            <!-- View Button (disabled for now) -->
                            <button class="btn btn-sm btn-outline-primary" >Read Online</button>

                            <!-- Return Button -->
                            <form method="POST" action="return_book.php">
                                <input type="hidden" name="transaction_id" value="<?= $book['transaction_id'] ?>">
                                <input type="hidden" name="book_id" value="<?= $book['book_id'] ?>">
                                <button class="btn btn-sm btn-outline-danger">Return</button>
                            </form>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        <?php else: ?>
            <p class="text-muted">You haven't borrowed any books yet.</p>
        <?php endif; ?>
    </div>
</div>
<?php include '../includes/footer.php'; ?>

</body>
</html>
