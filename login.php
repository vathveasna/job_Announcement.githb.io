<?php
session_start();
include_once('config/db.php');
$error = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email = '$email' LIMIT 1";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_email'] = $user['email'];
            header("Location: index.php");
            exit();
        } else { $error = "Invalid password."; }
    } else { $error = "No user found with that email."; }
}
include_once('header.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login | CareerVibe</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f8faff; }
        .auth-card { max-width: 400px; margin: 100px auto; border-radius: 20px; border: none; box-shadow: 0 10px 30px rgba(0,0,0,0.05); }
        .btn-green { background-color: #9ddd8c; font-weight: bold; border-radius: 10px; }
        .btn-green:hover { background-color: #12d47a; color: white; }
    </style>
</head>
<body>
    <div class="container">
        <div class="card auth-card p-4">
            <h3 class="text-center fw-bold mb-4" style="color: #12d47a;">CareerVibe</h3>
            <?php if($error) echo "<div class='alert alert-danger small'>$error</div>"; ?>
            <form method="POST">
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" required>
                </div>
                <div class="mb-3">
                    <div class="d-flex justify-content-between">
                        <label class="form-label">Password</label>
                        <a href="forgot_password.php" class="text-muted small">Forgot Password?</a>
                    </div>
                    <input type="password" name="password" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-green w-100 py-2">Login</button>
                <p class="text-center mt-3">Need an account? <a href="register.php" class="text-success">Register</a></p>
            </form>
        </div>
    </div>
</body>
<?php include_once('footer.php'); ?>
</html>