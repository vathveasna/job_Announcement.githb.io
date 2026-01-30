<?php
session_start();
require_once 'config/db.php';

$user_id = $_SESSION['user_id'] ?? 0;

$query = "SELECT j.title, j.job_nature as job_type, j.location, a.applied_at as date_created, a.status 
          FROM applied_jobs a 
          JOIN jobs j ON a.job_id = j.id 
          WHERE a.user_id = $user_id 
          ORDER BY a.applied_at DESC";

$result = mysqli_query($conn, $query);
$jobs = [];

while ($row = mysqli_fetch_assoc($result)) {
    // You can hardcode applicants_count or run a subquery
    $row['applicants_count'] = 12; // Example placeholder
    $jobs[] = $row;
}

header('Content-Type: application/json');
echo json_encode($jobs);