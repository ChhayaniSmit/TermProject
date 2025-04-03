<?php
session_start();
include '../includes/navbar.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>About - Libro</title>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/FinalProject/assets/css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body class="bg-light">

<div class="container py-5">
    <h2 class="text-center fw-bold mb-4">📘 About <span class="text-success">Libro</span></h2>

    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <p class="lead">
                        <strong>Libro</strong> is a modern and user-friendly Library Management System built to simplify book tracking, borrowing, and management. Whether you're a student searching for a book, a teacher managing resources, or a librarian overseeing the library's collection — Libro makes it easy.
                    </p>

                    <hr>

                    <h5 class="fw-bold mb-3"><i class="fas fa-bolt text-success me-2"></i> Key Features</h5>
                    <ul class="list-group list-group-flush mb-4">
                        <li class="list-group-item">🔍 Instant book search and filter by title, author, or category</li>
                        <li class="list-group-item">📚 Easy book borrowing and return process for students</li>
                        <li class="list-group-item">🧑‍💼 Admin control panel to manage users and books</li>
                        <li class="list-group-item">✅ Clean and responsive design built with Bootstrap 5</li>
                    </ul>

                    <h5 class="fw-bold mb-3"><i class="fas fa-users text-success me-2"></i> Built For</h5>
                    <p>📖 <strong>Students</strong> - Find and borrow your next read easily</p>
                    <p>📘 <strong>Librarians</strong> - Manage books and track returns effortlessly</p>
                    <p>🧑‍🏫 <strong>Teachers</strong> - Share resources and monitor availability</p>

                    <hr>
                    <p class="text-muted mt-4">Created as a final project to demonstrate full-stack development with PHP, MySQL, and Bootstrap.</p>
                    <p class="text-muted mt-4">Developed by <strong>Smit Chhayani</strong> as a final project.</p>

                </div>
            </div>
        </div>
    </div>
</div>
<?php include '../includes/footer.php'; ?>

</body>
</html>
