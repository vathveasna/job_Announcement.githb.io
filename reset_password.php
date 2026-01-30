<?php
include_once('config/db.php');
$email = $_GET['email'] ?? '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $pass = $_POST['password'];
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $hashed = password_hash($pass, PASSWORD_DEFAULT);
    mysqli_query($conn, "UPDATE users SET password = '$hashed' WHERE email = '$email'");
    echo "<script>alert('Password Reset Successful!'); window.location='login.php';</script>";
}
?>