<?php
session_start();
include '../includes/db_connect.php';
include '../includes/navbar.php';

// Redirect if no book ID is provided
if (!isset($_GET['book_id'])) {
    echo "No book selected.";
    exit();
}

$book_id = $_GET['book_id'];

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title']);
    $author = trim($_POST['author']);
    $category = trim($_POST['category']);
    $isbn = trim($_POST['isbn']);
    $status = $_POST['status'];
    $image_url = trim($_POST['image_url']);

    $sql = "UPDATE books SET title = ?, author = ?, category = ?, isbn = ?, status = ?, image_url = ? WHERE book_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssi", $title, $author, $category, $isbn, $status, $image_url, $book_id);

    if ($stmt->execute()) {
        $success = "Book updated successfully!";
    } else {
        $error = "Failed to update book.";
    }
}

// Fetch current book data
$sql = "SELECT * FROM books WHERE book_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $book_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo "Book not found.";
    exit();
}

$book = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Edit Book - Libro</title>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/FinalProject/assets/css/styles.css">
</head>
<body class="bg-light">

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card shadow-sm">
                <div class="card-body p-4">
                    <h3 class="text-center mb-4">✏️ Edit Book</h3>

                    <?php if (!empty($success)): ?>
                        <div class="alert alert-success"><?= $success ?></div>
                    <?php elseif (!empty($error)): ?>
                        <div class="alert alert-danger"><?= $error ?></div>
                    <?php endif; ?>

                    <form method="POST">
                        <div class="mb-3">
                            <label>Title</label>
                            <input type="text" name="title" class="form-control" value="<?= $book['title'] ?>" required>
                        </div>

                        <div class="mb-3">
                            <label>Author</label>
                            <input type="text" name="author" class="form-control" value="<?= $book['author'] ?>" required>
                        </div>

                        <div class="mb-3">
                            <label>Category</label>
                            <input type="text" name="category" class="form-control" value="<?= $book['category'] ?>" required>
                        </div>

                        <div class="mb-3">
                            <label>ISBN</label>
                            <input type="text" name="isbn" class="form-control" value="<?= $book['isbn'] ?>" required>
                        </div>

                        <div class="mb-3">
                            <label>Status</label>
                            <select name="status" class="form-select" required>
                                <option value="available" <?= $book['status'] === 'available' ? 'selected' : '' ?>>Available</option>
                                <option value="borrowed" <?= $book['status'] === 'borrowed' ? 'selected' : '' ?>>Borrowed</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label>Image URL (optional)</label>
                            <input type="text" name="image_url" class="form-control" value="<?= $book['image_url'] ?>">
                        </div>

                        <button type="submit" class="btn btn-primary w-100">Update Book</button>
                        <a href="admin_manage_books.php" class="btn btn-outline-secondary w-100 mt-3">← Back to Book List</a>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
