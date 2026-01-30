<?php
include_once('config/db.php');
$msg = "";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $res = mysqli_query($conn, "SELECT id FROM users WHERE email = '$email'");
    if (mysqli_num_rows($res) > 0) {
        header("Location: reset_password.php?email=" . urlencode($email));
        exit();
    } else {
        $msg = "We couldn't find an account with that email address.";
    }
}
include_once('header.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Forgot Password | CareerVibe</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="css/forgot_password.css">
    <style>
        
    </style>
</head>
<body>

<div class="container auth-container">
    <div class="card auth-card">
        <div class="card-header-visual"></div>
        <div class="p-5">
            <div class="text-center mb-4">
                <div class="icon-circle">
                    <i class="bi bi-key-fill"></i>
                </div>
                <h3 class="fw-bold mb-2">Reset Password</h3>
                <p class="text-muted small px-3">Enter your email and we'll send you instructions to reset your password.</p>
            </div>

            <?php if($msg): ?>
                <div class="alert alert-danger border-0 rounded-4 small py-3 px-3 mb-4 d-flex align-items-center" role="alert">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i>
                    <div><?php echo $msg; ?></div>
                </div>
            <?php endif; ?>

            <form method="POST">
                <div class="mb-4">
                    <label class="form-label">Email Address</label>
                    <div class="input-group">
                        <input type="email" name="email" class="form-control" placeholder="name@example.com" required>
                    </div>
                </div>

                <button type="submit" class="btn btn-green w-100 mb-4">
                    Send Reset Link <i class="bi bi-arrow-right-short ms-1"></i>
                </button>

                <div class="text-center">
                    <a href="login.php" class="back-link">
                        <i class="bi bi-chevron-left me-1"></i> Back to Login
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include_once('footer.php'); ?>

</body>
</html>