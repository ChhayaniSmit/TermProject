<?php
session_start();
include '../includes/db_connect.php';
include '../includes/navbar.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

$result = $conn->query("SELECT * FROM books ORDER BY book_id DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Manage Books - Libro</title>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/FinalProject/assets/css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body class="bg-light">

<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">📚 Manage Books</h2>
        <a href="add_book.php" class="btn btn-success"><i class="fas fa-plus me-1"></i> Add New Book</a>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-hover shadow-sm bg-white">
            <thead class="table-success text-center">
                <tr>
                    <th>#</th>
                    <th>Cover</th>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Category</th>
                    <th>ISBN</th>
                    <th>Status</th>
                    <th width="150px">Action</th>
                </tr>
            </thead>
            <tbody class="text-center">
                <?php if ($result->num_rows > 0): ?>
                    <?php while ($book = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?= $book['book_id'] ?></td>
                            <td>
                                <?php if (!empty($book['image_url'])): ?>
                                    <img src="/FinalProject/<?= $book['image_url'] ?>" alt="Cover" width="50" height="70">
                                <?php else: ?>
                                    <img src="/FinalProject/assets/images/default-book.png" alt="Default" width="50" height="70">
                                <?php endif; ?>
                            </td>
                            <td><?= $book['title'] ?></td>
                            <td><?= $book['author'] ?></td>
                            <td><?= $book['category'] ?></td>
                            <td><?= $book['isbn'] ?></td>
                            <td>
                                <?php if ($book['status'] === 'available'): ?>
                                    <span class="badge bg-success">Available</span>
                                <?php else: ?>
                                    <span class="badge bg-danger">Borrowed</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <a href="edit_book.php?book_id=<?= $book['book_id'] ?>" class="btn btn-sm btn-primary mb-1 w-100">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <form action="delete_book.php" method="POST" onsubmit="return confirm('Are you sure you want to delete this book?');">
                                    <input type="hidden" name="book_id" value="<?= $book['book_id'] ?>">
                                    <button type="submit" class="btn btn-sm btn-danger w-100">
                                        <i class="fas fa-trash-alt"></i> Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="8">No books found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<?php include '../includes/footer.php'; ?>

</body>
</html>
