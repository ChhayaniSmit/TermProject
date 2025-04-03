<?php
session_start();
include '../includes/db_connect.php';
include '../includes/navbar.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$sql = "SELECT * FROM books ORDER BY status ASC";
$result = $conn->query($sql);
?>
<?php if (isset($_GET['limit']) && $_GET['limit'] == 1): ?>
    <div class="alert alert-warning text-center">
        ⚠️ You have already borrowed 2 books. Return one to borrow another.
    </div>
<?php endif; ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <title>Books - Libro</title>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/FinalProject/assets/css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

</head>
<body class="bg-light">

<div class="container py-5">
    <h2 class="mb-4 text-center fw-bold">📚 Available Books</h2>

    <div class="row row-cols-1 row-cols-md-3 g-4">
        <?php if ($result && $result->num_rows > 0): ?>
            <?php while ($book = $result->fetch_assoc()): ?>
                <div class="col">
                    <div class="card h-100 shadow-sm position-relative">
                        <!-- Book Image -->
                        <?php if (!empty($book['image_url'])): ?>
                            <img src="/FinalProject/<?= $book['image_url'] ?>" class="card-img-top" alt="<?= $book['title'] ?>">
                        <?php else: ?>
                            <img src="/FinalProject/assets/images/default-book.png" class="card-img-top" alt="Default Book">
                        <?php endif; ?>

                        <!-- Badge -->
                        <?php if ($book['status'] === 'borrowed'): ?>
                            <span class="position-absolute top-0 start-0 bg-danger text-white px-3 py-1 fw-bold rounded-end">Not Available</span>
                        <?php else: ?>
                            <span class="position-absolute top-0 start-0 bg-success text-white px-3 py-1 fw-bold rounded-end">Available</span>
                        <?php endif; ?>

                        <!-- Book Info -->
                        <div class="card-body">
                            <h5 class="card-title"><?= $book['title'] ?></h5>
                            <p class="card-text">
                                <strong>Author:</strong> <?= $book['author'] ?><br>
                                <strong>Category:</strong> <?= $book['category'] ?><br>
                                <strong>ISBN:</strong> <?= $book['isbn'] ?>
                            </p>
                        </div>

                        <!-- Action Button -->
                        <div class="card-footer bg-white border-top-0">
                            <?php if ($book['status'] === 'available'): ?>
                                <form method="POST" action="borrow_book.php">
                                    <input type="hidden" name="book_id" value="<?= $book['book_id'] ?>">
                                    <button type="submit" class="btn btn-primary w-100">Borrow</button>
                                </form>
                            <?php else: ?>
                                <button class="btn btn-secondary w-100" disabled>Borrowed</button>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p class="text-center">No books found.</p>
        <?php endif; ?>
    </div>
</div>
<?php include '../includes/footer.php'; ?>

</body>
</html>
