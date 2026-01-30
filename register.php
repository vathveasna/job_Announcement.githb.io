<?php
include_once('config/db.php');
$message = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sanitize inputs
    $fullname = mysqli_real_escape_string($conn, $_POST['fullname']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Secure Hashing

    // Check if email already exists
    $checkEmail = mysqli_query($conn, "SELECT email FROM users WHERE email = '$email'");
    if (mysqli_num_rows($checkEmail) > 0) {
        $message = "<div class='alert alert-warning'>Email already registered!</div>";
    } else {
        // Updated SQL to include fullname
        $sql = "INSERT INTO users (fullname, email, password) VALUES ('$fullname', '$email', '$password')";
        if (mysqli_query($conn, $sql)) {
            header("Location: login.php?msg=registered");
            exit();
        } else {
            $message = "<div class='alert alert-danger'>Error creating account: " . mysqli_error($conn) . "</div>";
        }
    }
}
include_once('header.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register | CareerVibe</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f8faff; font-family: 'Plus Jakarta Sans', sans-serif; }
        .auth-card { max-width: 400px; margin: 60px auto; border-radius: 24px; border: none; box-shadow: 0 10px 40px rgba(0,0,0,0.08); background: #fff; }
        .btn-green { background-color: #9ddd8c; font-weight: 700; border-radius: 12px; color: #444; border: none; transition: 0.3s; }
        .btn-green:hover { background-color: #12d47a; color: white; transform: translateY(-2px); }
        .form-control { border-radius: 10px; padding: 12px; border: 1px solid #eee; }
        .form-label { font-weight: 600; font-size: 0.9rem; color: #555; }
    </style>
</head>
<body>
    <div class="container">
        <div class="card auth-card p-4">
            <div class="text-center mb-4">
                <h3 class="fw-bold" style="color: #12d47a;">Create Account</h3>
                <p class="text-muted small">Join CareerVibe to find your next opportunity</p>
            </div>

            <?php echo $message; ?>

            <form method="POST">
                <div class="mb-3">
                    <label class="form-label">Full Name</label>
                    <input type="text" name="fullname" class="form-control" placeholder="John Doe" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Email Address</label>
                    <input type="email" name="email" class="form-control" placeholder="name@example.com" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" placeholder="••••••••" required>
                </div>

                <button type="submit" class="btn btn-green w-100 py-3 mt-2">Sign Up</button>
                
                <p class="text-center mt-4 mb-0 small">
                    Already have an account? <a href="login.php" class="text-success fw-bold text-decoration-none">Login</a>
                </p>
            </form>
        </div>
    </div>
</body>
<?php include_once('footer.php'); ?>
</html>