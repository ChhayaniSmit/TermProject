<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$currentPage = basename($_SERVER['PHP_SELF']);
?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm sticky-top">
    <div class="container">
        <a class="navbar-brand fw-bold" href="/FinalProject/index.php">📘 Libro</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">

                <?php if (isset($_SESSION['user_id'])): ?>
                    <!-- Authenticated Links -->
                    <li class="nav-item">
                        <a class="nav-link <?= $currentPage === 'books.php' ? 'active' : '' ?>" href="/FinalProject/templates/books.php">
                            <i class="fas fa-book"></i> Books
                        </a>
                    </li>

                    <?php if ($_SESSION['role'] === 'admin'): ?>
                        <li class="nav-item">
                            <a class="nav-link <?= $currentPage === 'admin_dashboard.php' ? 'active' : '' ?>" href="/FinalProject/templates/admin_dashboard.php">
                                <i class="fas fa-cogs"></i> Admin Dashboard
                            </a>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a class="nav-link <?= $currentPage === 'user_dashboard.php' ? 'active' : '' ?>" href="/FinalProject/templates/user_dashboard.php">
                                <i class="fas fa-tachometer-alt"></i> Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= $currentPage === 'profile.php' ? 'active' : '' ?>" href="/FinalProject/templates/profile.php">
                                <i class="fas fa-user"></i> Profile
                            </a>
                        </li>
                    <?php endif; ?>

                    <li class="nav-item">
                        <a class="nav-link <?= $currentPage === 'about.php' ? 'active' : '' ?>" href="/FinalProject/templates/about.php">
                            <i class="fas fa-info-circle"></i> About
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="/FinalProject/logout.php">
                            <i class="fas fa-sign-out-alt"></i> Logout
                        </a>
                    </li>

                <?php else: ?>
                    <!-- Guest Links -->
                    <li class="nav-item">
                        <a class="nav-link <?= $currentPage === 'login.php' ? 'active' : '' ?>" href="/FinalProject/templates/login.php">
                            <i class="fas fa-sign-in-alt"></i> Login
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= $currentPage === 'register.php' ? 'active' : '' ?>" href="/FinalProject/templates/register.php">
                            <i class="fas fa-user-plus"></i> Register
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= $currentPage === 'about.php' ? 'active' : '' ?>" href="/FinalProject/templates/about.php">
                            <i class="fas fa-info-circle"></i> About
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= $currentPage === 'contact.php' ? 'active' : '' ?>" href="/FinalProject/templates/contact.php">
                            <i class="fas fa-envelope"></i> Contact
                        </a>
                    </li>
                <?php endif; ?>

            </ul>
        </div>
    </div>
</nav>
