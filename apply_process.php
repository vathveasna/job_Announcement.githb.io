<?php
session_start();
require_once 'config/db.php';

header('Content-Type: application/json');

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['status' => 'error', 'message' => 'Please login first.']);
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['job_id'])) {
    $job_id = intval($_POST['job_id']);
    $user_id = $_SESSION['user_id'];
    $applied_date = date('Y-m-d');

    // 1. Fetch job details to copy into the applied table
    $job_sql = "SELECT * FROM jobs WHERE id = $job_id";
    $job_res = mysqli_query($conn, $job_sql);
    $job = mysqli_fetch_assoc($job_res);

    if ($job) {
        $title = mysqli_real_escape_string($conn, $job['title']);
        $type = mysqli_real_escape_string($conn, $job['job_nature']);
        $loc = mysqli_real_escape_string($conn, $job['location']);

        // 2. CHECK: Prevent duplicate applications for the same job title by the same user
        $check_sql = "SELECT id FROM jobs_applied WHERE user_id = '$user_id' AND title = '$title'";
        $check_res = mysqli_query($conn, $check_sql);
        if (mysqli_num_rows($check_res) > 0) {
            echo json_encode(['status' => 'error', 'message' => 'You have already applied for this job.']);
            exit();
        }

        // 3. Insert into jobs_applied (Ensure user_id column exists in DB first)
        $insert = "INSERT INTO jobs_applied (user_id, title, job_type, location, date_created, applicants_count, status) 
                   VALUES ('$user_id', '$title', '$type', '$loc', '$applied_date', 0, 'Pending')";
        
        if (mysqli_query($conn, $insert)) {
            echo json_encode(['status' => 'success']);
        } else {
            // This will tell you if the 'user_id' column is still missing
            echo json_encode(['status' => 'error', 'message' => 'Database error: ' . mysqli_error($conn)]);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Job not found.']);
    }
}
?>