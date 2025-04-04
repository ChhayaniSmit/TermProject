<?php
session_start();
include '../includes/db_connect.php';
include '../includes/navbar.php';

// Ensure only admin can access
if ($_SESSION['role'] !== 'admin') {
    header("Location: user_dashboard.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $author = $_POST['author'];
    $category = $_POST['category'];
    $isbn = $_POST['isbn'];
    
    $sql = "INSERT INTO books (title, author, category, isbn, image_url, description, status)
        VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssssss", $title, $author, $category, $isbn, $image_url, $description, $status);
        $description = trim($_POST['description']);

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Book added successfully!'); window.location='admin_dashboard.php';</script>";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Book</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/FinalProject/assets/css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

</head>

<body>

<div class="container mt-5">
    <h2>Add New Book</h2>
    <form method="POST">
    <div class="mb-3">
        <label>Title</label>
        <input type="text" name="title" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Author</label>
        <input type="text" name="author" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Category</label>
        <input type="text" name="category" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>ISBN</label>
        <input type="text" name="isbn" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Image URL (optional)</label>
        <input type="text" name="image_url" class="form-control">
    </div>

    <div class="mb-3">
        <label>Description</label>
        <textarea name="description" class="form-control" rows="4" placeholder="Enter a short description about the book..."></textarea>
    </div>

    <div class="mb-3">
        <label>Status</label>
        <select name="status" class="form-select" required>
            <option value="available">Available</option>
            <option value="borrowed">Borrowed</option>
        </select>
    </div>

    <button type="submit" class="btn btn-primary w-100">Add Book</button>
</form>

</div>

</body>
</html>
