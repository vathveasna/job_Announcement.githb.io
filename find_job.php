<?php
// 1. Database connection
include_once('config/db.php');
include('header.php');


// 2. Handle Search Logic
$keywords   = $_GET['keywords'] ?? '';
$location   = $_GET['location'] ?? '';
$category   = $_GET['category'] ?? '';
$job_type   = $_GET['job_type'] ?? []; // Array for checkboxes
$experience = $_GET['experience'] ?? '';

$sql = "SELECT * FROM jobs WHERE 1";

if (!empty($keywords)) {
    $sql .= " AND title LIKE '%" . mysqli_real_escape_string($conn, $keywords) . "%'";
}
if (!empty($location)) {
    $sql .= " AND location LIKE '%" . mysqli_real_escape_string($conn, $location) . "%'";
}
if (!empty($category)) {
    $sql .= " AND category = '" . mysqli_real_escape_string($conn, $category) . "'";
}
if (!empty($job_type)) {
    $types = implode("','", array_map(function($type) use ($conn) {
        return mysqli_real_escape_string($conn, $type);
    }, $job_type));
    $sql .= " AND job_nature IN ('$types')";
}
if (!empty($experience)) {
    $sql .= " AND experience = '" . mysqli_real_escape_string($conn, $experience) . "'";
}

$sql .= " ORDER BY id DESC";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CareerVibe | Find Jobs</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="css/find_job.css">
</head>
<body>

<div class="container py-5">
    <div class="row">
        
        <div class="col-lg-3 mb-4">
            <form action="find_job.php" method="GET">
                <div class="filter-sidebar shadow-sm">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h5 class="fw-bold m-0">Filters</h5>
                        <a href="find_job.php" class="btn-clear">Clear All</a>
                    </div>
                    
                    <div class="mb-4">
                        <label class="filter-title">Keywords</label>
                        <input type="text" name="keywords" class="form-control" placeholder="Job title..." value="<?php echo htmlspecialchars($keywords); ?>">
                    </div>

                    <div class="mb-4">
                        <label class="filter-title">Location</label>
                        <input type="text" name="location" class="form-control" placeholder="City or Remote" value="<?php echo htmlspecialchars($location); ?>">
                    </div>

                    <div class="mb-4">
                        <label class="filter-title">Category</label>
                        <select name="category" class="form-select">
                            <option value="">Select Category</option>
                            <option value="Engineering" <?php if($category == 'Engineering') echo 'selected'; ?>>Engineering</option>
                            <option value="IT Support" <?php if($category == 'IT Support') echo 'selected'; ?>>IT Support</option>
                            <option value="sell" <?php if($category == 'sell') echo 'selected'; ?>>sell</option>
                            <option value="Marketing" <?php if($category == 'Marketing') echo 'selected'; ?>>Marketing</option>
                            <option value="Design" <?php if($category == 'Design') echo 'selected'; ?>>Design</option>
                            <option value="Information Technology" <?php if($category == 'Information Technology') echo 'selected'; ?>>Information Technology</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="filter-title">Job Type</label>
                        <?php 
                        $types_list = ['Full Time', 'Part Time', 'Freelance', 'Remote'];
                        foreach($types_list as $t): 
                        ?>
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="checkbox" name="job_type[]" value="<?php echo $t; ?>" id="type<?php echo $t; ?>" <?php if(in_array($t, $job_type)) echo 'checked'; ?>>
                            <label class="form-check-label" for="type<?php echo $t; ?>"><?php echo $t; ?></label>
                        </div>
                        <?php endforeach; ?>
                    </div>

                    <div class="mb-4">
                        <label class="filter-title">Experience</label>
                        <select name="experience" class="form-select">
                            <option value="">Select Experience</option>
                            <option value="Entry Level" <?php if($experience == 'Entry Level') echo 'selected'; ?>>Entry Level</option>
                            <option value="1-3 Years" <?php if($experience == '1-3 Years') echo 'selected'; ?>>1-3 Years</option>
                            <option value="5+ Years" <?php if($experience == '5+ Years') echo 'selected'; ?>>5+ Years</option>
                        </select>
                    </div>

                    <button type="submit" class="btn details-btn w-100">Apply Filters</button>
                </div>
            </form>
        </div>

        <div class="col-lg-9">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="fw-bold">Find Jobs</h2>
                <div class="dropdown">
                    <button class="btn btn-white border shadow-sm dropdown-toggle" type="button" data-bs-toggle="dropdown">
                        Latest
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-menu" href="#">Oldest</a></li>
                    </ul>
                </div>
            </div>

            <div class="row">
                <?php if($result && mysqli_num_rows($result) > 0): ?>
                    <?php while($row = mysqli_fetch_assoc($result)): ?>
                        <div class="col-md-6 col-xl-4 mb-4">
                            <div class="card job-card p-4 shadow-sm">
                                <h5 class="job-title mb-1"><?php echo htmlspecialchars($row['title']); ?></h5>
                                <p class="text-muted small mb-4">Join our team to build the future.</p>
                                
                                <div class="job-meta-box">
                                    <div class="meta-item">
                                        <i class="bi bi-geo-alt"></i>
                                        <span><?php echo htmlspecialchars($row['location']); ?></span>
                                    </div>
                                    <div class="meta-item">
                                        <i class="bi bi-clock"></i>
                                        <span><?php echo htmlspecialchars($row['job_nature']); ?></span>
                                    </div>
                                    <div class="meta-item">
                                        <i class="bi bi-currency-dollar"></i>
                                        <span class="salary-text"><?php echo htmlspecialchars($row['salary']); ?></span>
                                    </div>
                                </div>

                                <a href="job_detail.php?id=<?php echo $row['id']; ?>" class="btn details-btn w-100">Details</a>
                            </div>
                        </div>
                    <?php endwhile; ?>
                <?php else: ?>
                    <div class="col-12 text-center py-5">
                        <i class="bi bi-search display-1 text-muted opacity-25"></i>
                        <h4 class="mt-3 text-muted">No jobs found matching your criteria.</h4>
                    </div>
                <?php endif; ?>
            </div>
        </div>

    </div>
</div>
<?php include('footer.php'); ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>