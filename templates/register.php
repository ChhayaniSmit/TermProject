<?php
session_start();
include '../includes/db_connect.php';
include '../includes/navbar.php';

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first = trim($_POST["first_name"]);
    $last = trim($_POST["last_name"]);
    $mobile = trim($_POST["mobile"]);
    $email = trim($_POST["email"]);
    $address_line1 = trim($_POST['address_line1']);
    $address_line2 = trim($_POST['address_line2']);
    $city = trim($_POST['city']);
    $province = trim($_POST['province']);
    $postal_code = trim($_POST['postal_code']);
    $password = $_POST["password"];
    $confirm = $_POST["confirm_password"];

    if ($password !== $confirm) {
        $error = "Passwords do not match.";
    } else {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $name = $first . " " . $last;

        $sql = "INSERT INTO users (name, email, password, mobile, address_line1, address_line2, city, province, postal_code, role)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, 'patron')";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssssssss", $name, $email, $hash, $mobile, $address_line1, $address_line2, $city, $province, $postal_code);

        if ($stmt->execute()) {
            header("Location: login.php");
            exit();
        } else {
            $error = "Email already exists or registration failed.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Register - Libro</title>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/FinalProject/assets/css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

</head>
<body class="bg-light">

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card shadow-sm">
                <div class="card-body p-4">
                    <h3 class="text-center mb-4">📝 Create a New Account</h3>

                    <?php if (!empty($error)): ?>
                        <div class="alert alert-danger"><?= $error ?></div>
                    <?php endif; ?>

                    <form method="POST" action="">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label>First Name</label>
                            <input type="text" name="first_name" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label>Last Name</label>
                            <input type="text" name="last_name" class="form-control" required>
                        </div>
                    </div>

                    <div class="mt-3">
                        <label>Mobile Number</label>
                        <input type="text" name="mobile" class="form-control" required pattern="[0-9]{10,15}" title="Only numbers allowed">
                    </div>

                    <div class="mt-3">
                        <label>Email Address</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>

                    <!-- Address Section -->
                    <div class="mt-4">
                        <label>Address Line 1</label>
                        <input type="text" name="address_line1" class="form-control" required>
                    </div>

                    <div class="mt-3">
                        <label>Address Line 2 (optional)</label>
                        <input type="text" name="address_line2" class="form-control">
                    </div>

                    <div class="row g-3 mt-3">
                        <div class="col-md-4">
                            <label>City</label>
                            <input type="text" name="city" class="form-control" required>
                        </div>
                        <div class="col-md-4">
                        <label>Province</label>
                            <select name="province" class="form-select" required>
                                <option value="">Select Province</option>
                                <option>Alberta</option>
                                <option>British Columbia</option>
                                <option>Manitoba</option>
                                <option>New Brunswick</option>
                                <option>Newfoundland and Labrador</option>
                                <option>Nova Scotia</option>
                                <option>Ontario</option>
                                <option>Prince Edward Island</option>
                                <option>Quebec</option>
                                <option>Saskatchewan</option>
                                <option>Northwest Territories</option>
                                <option>Nunavut</option>
                                <option>Yukon</option>
                            </select>

                        </div>
                        <div class="col-md-4">
                            <label>Postal Code</label>
                            <input type="text" name="postal_code" class="form-control" required pattern="[A0B]{1A2}" title="Enter a valid postal code">
                        </div>
                    </div>

                    <!-- Password -->
                    <div class="row g-3 mt-4">
                        <div class="col-md-6">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label>Confirm Password</label>
                            <input type="password" name="confirm_password" class="form-control" required>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary w-100 mt-4">Register</button>
                </form>


                    <div class="text-center mt-3">
                        <p>Already have an account? <a href="login.php">Login here</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include '../includes/footer.php'; ?>

</body>
</html>
