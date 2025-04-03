<?php
session_start();
include 'includes/navbar.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Welcome to Libro</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/FinalProject/assets/css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<body class="bg-light">

<!-- Hero Section -->
<div class="container text-center py-5">
    <h1 class="display-4 fw-bold">📘 Welcome to <span class="text-success">Libro</span></h1>
    <p class="lead mt-3">
        A modern Library Management System for students, teachers, and librarians to manage books efficiently.
    </p>

    <div class="mt-4">
        <?php if (!isset($_SESSION['user_id'])): ?>
            <a href="templates/register.php" class="btn btn-outline-primary btn-lg me-3">
                <i class="fas fa-user-plus me-1"></i> Create Account
            </a>
            <a href="templates/login.php" class="btn btn-primary btn-lg">
                <i class="fas fa-sign-in-alt me-1"></i> Login
            </a>
        <?php else: ?>
            <a href="templates/books.php" class="btn btn-success btn-lg me-3">
                <i class="fas fa-book-open me-1"></i> Browse Books
            </a>
            <?php if ($_SESSION['role'] === 'admin'): ?>
                <a href="templates/admin_dashboard.php" class="btn btn-dark btn-lg">
                    <i class="fas fa-cogs me-1"></i> Admin Dashboard
                </a>
            <?php else: ?>
                <a href="templates/user_dashboard.php" class="btn btn-dark btn-lg">
                    <i class="fas fa-user-circle me-1"></i> My Dashboard
                </a>
            <?php endif; ?>
        <?php endif; ?>
    </div>
</div>

<!-- Features Section -->
<div class="container mt-5">
    <h2 class="text-center mb-4">🌟 Features</h2>
    <div class="row g-4">
        <div class="col-md-4">
            <div class="card h-100 shadow-sm border-0">
                <div class="card-body text-center">
                    <i class="fas fa-search fa-2x mb-3 text-success"></i>
                    <h5 class="card-title">Search & Filter</h5>
                    <p class="card-text">Find books instantly by title, author, category, or ISBN.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card h-100 shadow-sm border-0">
                <div class="card-body text-center">
                    <i class="fas fa-exchange-alt fa-2x mb-3 text-success"></i>
                    <h5 class="card-title">Borrow & Return</h5>
                    <p class="card-text">Borrow books and return them easily from your dashboard.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card h-100 shadow-sm border-0">
                <div class="card-body text-center">
                    <i class="fas fa-user-shield fa-2x mb-3 text-success"></i>
                    <h5 class="card-title">Admin Control</h5>
                    <p class="card-text">Admins can manage books and track borrowing activities.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Testimonials Section -->
<!-- Testimonials Section -->
<div class="container mt-5">
    <h2 class="text-center fw-bold mb-4">💬 What Our Users Say</h2>
    <div class="row text-center g-4">
        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <i class="fas fa-user-graduate fa-2x text-success mb-3"></i>
                    <p class="card-text fst-italic">“Libro makes it so easy to find and borrow books. I use it weekly!”</p>
                    <h6 class="mt-3 mb-0 fw-semibold">Riya Patel</h6>
                    <small class="text-muted">Student</small>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <i class="fas fa-chalkboard-teacher fa-2x text-success mb-3"></i>
                    <p class="card-text fst-italic">“Our students are more organized since we introduced Libro.”</p>
                    <h6 class="mt-3 mb-0 fw-semibold">Mr. Ben Kam</h6>
                    <small class="text-muted">Teacher</small>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <i class="fas fa-user-tie fa-2x text-success mb-3"></i>
                    <p class="card-text fst-italic">“Managing the entire library has never been this smooth.”</p>
                    <h6 class="mt-3 mb-0 fw-semibold">Ms. Sharma</h6>
                    <small class="text-muted">Librarian</small>
                </div>
            </div>
        </div>
    </div>
</div>


<?php include 'includes/footer.php'; ?>

</body>
</html>
