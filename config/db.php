<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "post_job"; // Must match the name in your phpMyAdmin

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>