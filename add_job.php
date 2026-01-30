<?php
session_start();
// FIX: Path adjusted based on your folder structure (config is inside PHP_PROGRAM)
require_once 'config/db.php'; 

/** * FIX 1: REMOVE HARDCODED TEST DATA
 * We delete the block that forced the name to "Mohit Singh".
 * Instead, we check if the user is actually logged in.
 */
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

/**
 * FIX 2: DYNAMIC NAME LOGIC
 * We extract the name from the email (e.g., "snazy") just like in your navbar.
 */
$displayName = isset($_SESSION['user_name']) ? $_SESSION['user_name'] : explode('@', $_SESSION['user_email'])[0];
$displayRole = isset($_SESSION['user_role']) ? $_SESSION['user_role'] : "Employer";

$success_msg = ""; 

if (isset($_POST['submit_job'])) {
    // Sanitize inputs
    $title       = mysqli_real_escape_string($conn, $_POST['title']);
    $category    = mysqli_real_escape_string($conn, $_POST['category']);
    $job_nature  = mysqli_real_escape_string($conn, $_POST['job_nature']);
    $vacancy     = mysqli_real_escape_string($conn, $_POST['vacancy']);
    $salary      = mysqli_real_escape_string($conn, $_POST['salary']);
    $location    = mysqli_real_escape_string($conn, $_POST['location']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $benefits    = mysqli_real_escape_string($conn, $_POST['benefits']);

    $sql = "INSERT INTO jobs (title, category, job_nature, vacancy, salary, location, description, benefits) 
            VALUES ('$title', '$category', '$job_nature', '$vacancy', '$salary', '$location', '$description', '$benefits')";

    if (mysqli_query($conn, $sql)) {
        $success_msg = "Job posted successfully!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Post a Job | CareerVibe</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; }
        .sidebar-card { border: none; box-shadow: 0 0 10px rgba(0,0,0,0.1); border-radius: 8px; background: #fff; }
        .profile-circle { width: 100px; height: 100px; border-radius: 50%; background: #e9ecef; margin: 0 auto 15px; overflow: hidden; }
        .profile-circle img { width: 100%; height: 100%; object-fit: cover; }
        .btn-custom { background-color: #9ddd8c; color: white; border: none; }
        .btn-custom:hover { background-color: #8ccb7d; color: white; }
        .nav-link-custom { color: #333; text-decoration: none; display: block; padding: 10px 15px; border-bottom: 1px solid #eee; }
        .nav-link-custom:hover { color: #9ddd8c; background: #fdfdfd; }
    </style>
</head>
<body>

<div class="container py-5">
    <div class="row">
        <div class="col-md-3">
            <div class="card sidebar-card text-center p-4 mb-3">
                <div class="profile-circle">
                    <img src="image/avatar7.png" alt="User">
                </div>
                <h5 class="text-capitalize"><?php echo htmlspecialchars($displayName); ?></h5>
                <p class="text-muted small"><?php echo htmlspecialchars($displayRole); ?></p>
                <button class="btn btn-custom btn-sm w-100" data-bs-toggle="modal" data-bs-target="#profileModal">Change Profile Picture</button>
            </div>
            <div class="card sidebar-card">
                <a href="account.php" class="nav-link-custom">Account Settings</a>
                <a href="add_job.php" class="nav-link-custom fw-bold text-success">Post a Job</a>
                <a href="my_jobs.php" class="nav-link-custom">My Jobs</a>
                <a href="applied.php" class="nav-link-custom">Jobs Applied</a>
                <a href="find_jobs.php" class="nav-link-custom border-0">Saved Jobs</a>
            </div>
        </div>

        <div class="col-md-9">
            <div class="card sidebar-card p-4">
                <h4 class="mb-4 border-bottom pb-2">Job Details</h4>
                <?php if(!empty($success_msg)) echo "<div class='alert alert-success'>$success_msg</div>"; ?>
                
                <form method="POST">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label small fw-bold">Title *</label>
                            <input type="text" name="title" class="form-control" placeholder="Job Title" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-bold">Category *</label>
                            <select name="category" class="form-select" required>
                                <option value="">Select a Category</option>
                                <option value="IT">IT & Software</option>
                                <option value="Design">Design & Creative</option>
                                <option value="Engineering">Engineering</option>
                                <option value="Accountant">Accountant</option>
                                <option value="Marketing">Marketing</option>
                                <option value="Sales">Sales</option>
                                <option value="Human Resource">Human Resource</option>
                                <option value="Customer Support">Customer Support</option>
                                <option value="Information Technology">Information Technology</option>
                                <option value="Fashion Designing">Fashion Designing</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-bold">Job Nature *</label>
                            <select name="job_nature" class="form-select">
                                <option value="Full Time">Full Time</option>
                                <option value="Part Time">Part Time</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-bold">Vacancy *</label>
                            <input type="number" name="vacancy" class="form-control" placeholder="Vacancy" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-bold">Salary</label>
                            <input type="text" name="salary" class="form-control" placeholder="Salary">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-bold">Location *</label>
                            <input type="text" name="location" class="form-control" placeholder="Location" required>
                        </div>
                        <div class="col-12">
                            <label class="form-label small fw-bold">Description *</label>
                            <textarea name="description" class="form-control" rows="4" placeholder="Description" required></textarea>
                        </div>
                        <div class="col-12">
                            <label class="form-label small fw-bold">Benefits</label>
                            <textarea name="benefits" class="form-control" rows="3" placeholder="Benefits"></textarea>
                        </div>
                    </div>
                    <button type="submit" name="submit_job" class="btn btn-custom mt-4 px-4">Save Job</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="profileModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Change Profile Picture</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="update_profile.php" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <label class="form-label small">Profile Image</label>
                    <input type="file" name="image" class="form-control" required>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-custom">Update</button>
                    <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>