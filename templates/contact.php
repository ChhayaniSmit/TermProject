<?php
session_start();
include '../includes/navbar.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Contact Us - Libro</title>
    <meta charset="UTF-8">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/FinalProject/assets/css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

</head>
<body class="bg-light">

<div class="container py-5">
    <h2 class="text-center mb-4">📞 Contact Us</h2>
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card shadow-sm p-4">
                <form method="POST" action="#">
                    <div class="mb-3">
                        <label>Your Name</label>
                        <input type="text" class="form-control" placeholder="Enter your name" required>
                    </div>
                    <div class="mb-3">
                        <label>Email Address</label>
                        <input type="email" class="form-control" placeholder="you@example.com" required>
                    </div>
                    <div class="mb-3">
                        <label>Message</label>
                        <textarea class="form-control" rows="5" placeholder="Write your message here..." required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Send Message</button>
                </form>
            </div>

            <div class="text-center mt-4">
                <p>Or reach us directly at <strong>support@libro.com</strong></p>
            </div>

        </div>
    </div>
</div>
<?php include '../includes/footer.php'; ?>

</body>
</html>
