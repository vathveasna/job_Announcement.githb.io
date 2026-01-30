<?php
session_start();
require_once 'config/db.php'; 

// 1. Get ID from URL safely
$job_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// 2. Fetch specific job data
$job = null;
if ($job_id > 0) {
    // Use prepared statements or at least ensure $job_id is an int
    $query = "SELECT * FROM jobs WHERE id = $job_id";
    $result = mysqli_query($conn, $query);
    $job = mysqli_fetch_assoc($result);
}

// 3. If job doesn't exist, go back to list
if (!$job) {
    header("Location: find_job.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($job['title']); ?> | CareerVibe</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        body { background-color: #f4f7f6; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        .back-link { color: #9ddd8c; text-decoration: none; font-weight: 500; display: inline-block; margin-bottom: 20px; }
        .main-card, .side-card { background: #fff; border: none; border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.05); padding: 40px; }
        .job-title-header { color: #9ddd8c; font-weight: 700; font-size: 2rem; }
        .meta-info { color: #888; font-size: 0.95rem; margin-bottom: 30px; }
        .section-title { font-weight: 700; color: #222; margin-top: 30px; margin-bottom: 15px; }
        .content-body { color: #555; line-height: 1.8; }
        .sidebar-title { font-weight: 700; font-size: 1.2rem; border-bottom: 1px solid #eee; padding-bottom: 10px; margin-bottom: 20px; }
        .summary-list { list-style: none; padding: 0; }
        .summary-list li { margin-bottom: 12px; font-size: 0.95rem; }
        .summary-list b { color: #333; font-weight: 600; }
        .btn-apply { background-color: #9ddd8c; color: white; padding: 12px 30px; border: none; border-radius: 5px; font-weight: 600; }
        .btn-save { background-color: #333; color: white; padding: 12px 30px; border-radius: 5px; margin-right: 10px; border: none; }
        .btn-apply:hover { background-color: #8cc63f; color: white; }
    </style>
</head>
<body>

<div class="container py-5">
    <a href="find_job.php" class="back-link"><i class="bi bi-arrow-left"></i> Back to Jobs</a>

    <div class="row">
        <div class="col-lg-8">
            <div class="main-card">
                <h1 class="job-title-header"><?php echo htmlspecialchars($job['title']); ?></h1>
                <div class="meta-info">
                    <i class="bi bi-geo-alt"></i> <?php echo htmlspecialchars($job['location']); ?> 
                    <span class="ms-3"><i class="bi bi-clock"></i> <?php echo htmlspecialchars($job['job_nature']); ?></span>
                </div>

                <h5 class="section-title">Job description</h5>
                <div class="content-body">
                    <?php echo nl2br(htmlspecialchars($job['description'])); ?>
                </div>

                <h5 class="section-title">Benefits</h5>
                <div class="content-body">
                    <?php echo nl2br(htmlspecialchars($job['benefits'])); ?>
                </div>

                <div class="mt-5">
                    <button class="btn btn-save shadow-sm">Save</button>
                    <button id="applyBtn" class="btn btn-apply shadow-sm" onclick="applyForJob(<?php echo $job_id; ?>)">
                        Apply Now
                    </button>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="side-card mb-4">
                <div class="sidebar-title">Job Summary</div>
                <ul class="summary-list">
                    <li>Published on: <b><?php echo date('d M, Y', strtotime($job['created_at'])); ?></b></li>
                    <li>Vacancy: <b><?php echo htmlspecialchars($job['vacancy']); ?> Position</b></li>
                    <li>Salary: <b>$<?php echo htmlspecialchars($job['salary']); ?></b></li>
                    <li>Location: <b><?php echo htmlspecialchars($job['location']); ?></b></li>
                    <li>Job Nature: <b><?php echo htmlspecialchars($job['job_nature']); ?></b></li>
                </ul>
            </div>

            <div class="side-card">
                <div class="sidebar-title">Company Details</div>
                <ul class="summary-list">
                    <li>Name: <b>XYZ Company</b></li>
                    <li>Location: <b><?php echo htmlspecialchars($job['location']); ?></b></li>
                    <li>Website: <b>www.example.com</b></li>
                </ul>
            </div>
        </div>
    </div>
</div>

<script>
function applyForJob(jobId) {
    const btn = document.getElementById('applyBtn');
    
    if(!confirm("Are you sure you want to apply for this position?")) return;

    btn.disabled = true;
    btn.innerText = "Processing...";

    // Send data to 'apply_process.php'
    fetch('apply_process.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: 'job_id=' + jobId
    })
    .then(response => response.json())
    .then(data => {
        if(data.status === 'success') {
            alert("Application submitted!");
            window.location.href = 'applied.php'; 
        } else {
            alert("Error: " + data.message);
            btn.disabled = false;
            btn.innerText = "Apply Now";
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert("An error occurred. Please try again.");
        btn.disabled = false;
        btn.innerText = "Apply Now";
    });
}
</script>

</body>
</html>