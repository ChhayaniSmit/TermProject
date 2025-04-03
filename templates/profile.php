<?php
session_start();
include '../includes/db_connect.php';
include '../includes/navbar.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$sql = "SELECT * FROM users WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>My Profile - Libro</title>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/FinalProject/assets/css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

</head>
<body class="bg-light">

<div class="container py-5">
    <h2 class="mb-4 text-center fw-bold"><i class="fas fa-user-circle"></i> My Profile</h2>

    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card shadow-sm">
                <div class="card-body p-4">
                    <p><strong>Name:</strong> <?= $user['name'] ?></p>
                    <p><strong>Email:</strong> <?= $user['email'] ?></p>
                    <p><strong>Mobile:</strong> <?= $user['mobile'] ?? '—' ?></p>
                    <p><strong>Address:</strong> <?= $user['address'] ?? '—' ?></p>
                    <p><strong>Role:</strong> <?= ucfirst($user['role']) ?></p>

                    <a href="edit_profile.php" class="btn btn-outline-primary w-100 mt-3">Edit Profile</a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include '../includes/footer.php'; ?>

</body>
</html>
