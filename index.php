<?php

session_start(); // <--- ADD THIS LINE FIRST
// ... rest of your code ...
// Include database connection
include_once('config/db.php');


// 1. Logic: Get search parameters
$keywords  = $_GET['keywords'] ?? '';
$location  = $_GET['location'] ?? '';
$category  = $_GET['category'] ?? '';

// Build Search Query
$sql = "SELECT * FROM jobs WHERE 1";
if (!empty($keywords)) { $sql .= " AND title LIKE '%" . mysqli_real_escape_string($conn, $keywords) . "%'"; }
if (!empty($location)) { $sql .= " AND location LIKE '%" . mysqli_real_escape_string($conn, $location) . "%'"; }
if (!empty($category)) { $sql .= " AND category = '" . mysqli_real_escape_string($conn, $category) . "'"; }
$sql .= " ORDER BY id DESC";

$result = mysqli_query($conn, $sql);
$pageTitle = "CareerVibe | Find Best Jobs";

// 2. Fetch Dynamic Category Counts for the "Popular Categories" section
$cat_counts_query = "SELECT category, COUNT(*) as total FROM jobs GROUP BY category LIMIT 8";
$cat_counts_result = mysqli_query($conn, $cat_counts_query);

$db_categories = [];
if ($cat_counts_result) {
    while($row = mysqli_fetch_assoc($cat_counts_result)) {
        $db_categories[] = ['name' => $row['category'], 'count' => $row['total']];
    }
}
 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $pageTitle; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Kantumruy+Pro:wght@400;700&family=Plus+Jakarta+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
           /* Root Variables */
        :root {
            --primary-green: #9ddd8c;
            --dark-green: #12d47a;
            --soft-bg: #f8faff;
            --text-main: #2d3436;
        }

        body { 
            font-family: 'Plus Jakarta Sans', sans-serif; 
            background-color: var(--soft-bg); 
            color: var(--text-main);
        }
        
        .khmer-text { font-family: 'Kantumruy Pro', sans-serif; }

        /* Navbar */
        .navbar { background: rgba(255, 255, 255, 0.95); backdrop-filter: blur(10px); box-shadow: rgba(50, 50, 93, 0.25) 0px 30px 60px -12px, rgba(0, 0, 0, 0.3) 0px 18px 36px -18px; }

        /* Hero Section */
        .hero-section {
            background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url('image/banner5.jpg');
            background-size: cover;
            background-position: center;
            min-height: 500px;
            display: flex;
            align-items: center;
            color: white;
            
            
        }

        /* Floating Search Card */
        .search-card {
            margin-top: -60px;
            border: none;
            border-radius: 24px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.06);
            background: #ffffff;
        }

        /* Category Cards */
        .category-card {
            background: #ffffff;
            border: 1px solid #edf2f7;
            border-radius: 20px;
            padding: 24px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            text-decoration: none;
            display: block;
            height: 100%;
        }

        .category-card:hover {
            transform: translateY(-8px);
            border-color: var(--primary-green);
            box-shadow: 0 12px 24px rgba(157, 221, 140, 0.15);
        }

        .category-title {
            color: var(--primary-green);
            font-weight: 700;
            font-size: 1.1rem;
            margin-bottom: 4px;
        }

        /* Job Cards */
        .job-card {
            border-radius: 24px;
            border: 1px solid #f1f5f9;
            transition: all 0.3s ease;
            background: #ffffff;
        }
        .job-card:hover {
            transform: scale(1.02);
            box-shadow: 0 20px 30px rgba(0,0,0,0.05);
        }

        .job-details-box {
            background-color: #f8fafc;
            border-radius: 16px;
            padding: 16px;
        }

        .btn-custom-primary {
            background-color: var(--primary-green);
            border: none;
            color:#804040 ;
            font-weight: 300;
            border-radius: 14px;
            padding: 12px 24px;
            transition: all 0.3s ease;
        }

        .btn-custom-primary:hover {
            background-color: var(--dark-green);
            color: white;
            transform: translateY(-2px);
            box-shadow: rgba(0, 0, 0, 0.4) 0px 2px 4px, rgba(0, 0, 0, 0.3) 0px 7px 13px -3px, rgba(0, 0, 0, 0.2) 0px -3px 0px inset;
        }

        .section-line {
            width: 50px;
            height: 4px;
            background: var(--primary-green);
            border-radius: 2px;
            margin-bottom: 25px;
        }

        .description-truncate {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            min-height: 3em;
        }

        /* Styling to match image_f5b3f4.png */
    .search-card {
        border: none !important;
        border-radius: 20px !important; /* High border radius for rounded look */
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1) !important;
        margin-top: -50px; 
        background: #fff;
        z-index: 10;
        position: relative;
    }

    .search-card .input-group {
        border: 1px solid #e0e0e0;
        border-radius: 8px;
    }

    .search-card .input-group-text {
        background-color: transparent;
        border: none;
        color: #999;
        padding-right: 0;
    }

    .search-card .form-control {
        border: none !important;
        box-shadow: none !important;
        font-size: 16px;
    }

    .search-card .form-select {
        border: 1px solid #e0e0e0;
        border-radius: 8px;
        color: #333;
    }

    .btn-custom-primary {
        background-color: #a8e091 !important; /* Light green from image */
        border: none !important;
        color: #444 !important; /* Darker text for the button */
        font-weight: 700 !important;
        border-radius: 12px !important; /* Rounded button */
        padding: 10px 30px !important;
        transition: 0.3s;
    }

    .btn-custom-primary:hover {
        background-color: #95d67a !important;
        transform: translateY(-1px);
    }
    
    </style>
   
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light sticky-top py-3">
    <div class="container">
        <a class="navbar-brand fw-bold fs-3" href="index.php" style="color: var(--dark-green);">CareerVibe</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item"><a class="nav-link fw-semibold" href="index.php">Home</a></li>
                <li class="nav-item"><a class="nav-link fw-semibold" href="find_job.php">Find Jobs</a></li>
            </ul>
            
            <div class="d-flex align-items-center">
                <?php if(isset($_SESSION['user_id'])): ?>
                    <span class="navbar-text me-3">Welcome, <strong><?php echo explode('@', $_SESSION['user_email'])[0]; ?></strong></span>
                    
                    <a class="nav-link fw-semibold me-3" href="my_jobs.php">My Jobs</a>
                    
                    <a class="btn btn-outline-dark me-2 px-4" href="add_job.php">Post a Job</a>
                    <a class="btn btn-danger px-4" href="logout.php">Logout</a>
                <?php else: ?>
                    <a class="btn btn-outline-dark me-2 px-4" href="login.php">Login</a>
                    <a class="btn btn-success text-white px-4" href="register.php">Sign Up</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</nav>
<section class="hero-section">
    <div class="container">
        <div class="col-lg-7">
            <h1 class="fw-bold display-3 mb-3" style="font-size: 55px; margin-bottom: 50px;">Find your dream job</h1>
            <p class="lead mb-4 opacity-50" style="font-size: 20px;">Connecting talented people with
             top companies in Cambodia. Start your journey today.</p>
            <a href="#search-area" class="btn btn-custom-primary btn-lg px-3 shadow-lg" style="font-size: 15px;">Get Started</a>
        </div>
    </div>
</section>

<section id="search-area" class="pb-5">
    <div class="container">
        <form action="index.php" method="GET" class="card search-card p-4">
            <div class="row g-3 align-items-center">
                
                <div class="col-md-4">
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-search"></i></span>
                        <input type="text" name="keywords" class="form-control form-control-lg" 
                               placeholder="Job keywords..." 
                               value="<?php echo htmlspecialchars($keywords); ?>">
                    </div>
                </div>
                
                <div class="col-md-3">
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-geo-alt"></i></span>
                        <input type="text" name="location" class="form-control form-control-lg" 
                               placeholder="Location" 
                               value="<?php echo htmlspecialchars($location); ?>">
                    </div>
                </div>
                
                <div class="col-md-3">
                    <select name="category" class="form-select form-select-lg">
                        <option value="">All Categories</option>
                        <option value="IT Support" <?php if($category == 'IT Support') echo 'selected'; ?>>IT Support</option>
                        <option value="Marketing" <?php if($category == 'Marketing') echo 'selected'; ?>>Marketing</option>
                        <option value="Design" <?php if($category == 'Design') echo 'selected'; ?>>Design</option>
                    </select>
                </div>
                
                <div class="col-md-2 d-grid">
                    <button type="submit" class="btn btn-custom-primary">Search</button>
                </div>
            </div>
        </form>
    </div>
</section>

<section class="py-5">
    <div class="container">
        <div class="mb-4">
            <h2 class="fw-bold mb-1">Popular Categories</h2>
            <div class="section-line"></div>
        </div>

        <div class="row g-4">
            <?php if (!empty($db_categories)): ?>
                <?php foreach ($db_categories as $cat): ?>
                    <div class="col-6 col-md-4 col-lg-3 ">
                        <a href="index.php?category=<?php echo urlencode($cat['name']); ?>" class="category-card shadow-sm">
                            <div class="category-title"><?php echo htmlspecialchars($cat['name']); ?></div>
                            <div class="text-muted small"><?php echo $cat['count']; ?> Available positions</div>
                        </a>
                    </div>

                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-12"><p class="text-muted">No categories available yet.</p></div>
            <?php endif; ?>
        </div>
    </div>
</section>

<div class="container pb-5 mt-4">
    <div class="d-flex justify-content-between align-items-end mb-4">
        <div>
            <h2 class="fw-bold mb-1">Available Jobs</h2>
            <div class="section-line"></div>
        </div>
        <span class="badge bg-white text-dark border rounded-pill px-4 py-2 mb-4">
            <span class="text-success fw-bold"><?php echo ($result) ? mysqli_num_rows($result) : 0; ?></span> Positions Found
        </span>
    </div>

    <div class="row">
        <?php if($result && mysqli_num_rows($result) > 0): ?>
            <?php while($row = mysqli_fetch_assoc($result)): ?>
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card job-card h-100 p-4 border-0 shadow-sm">
                        <div class="d-flex align-items-center mb-3">
                            <div class="bg-light p-3 rounded-4 me-3">
                                <i class="bi bi-briefcase text-success fs-4"></i>
                            </div>
                            <h5 class="fw-bold m-0"><?php echo htmlspecialchars($row['title']); ?></h5>
                        </div>
                        
                        <p class="text-muted small khmer-text description-truncate mb-4">
                            <?php echo htmlspecialchars($row['description']); ?>
                        </p>

                        <div class="job-details-box mb-4">
                            <div class="small mb-2 d-flex align-items-center"><i class="bi bi-geo-alt me-2 text-danger"></i><?php echo htmlspecialchars($row['location']); ?></div>
                            <div class="small mb-2 d-flex align-items-center"><i class="bi bi-clock me-2 text-primary"></i><?php echo htmlspecialchars($row['job_nature']); ?></div>
                            <div class="small fw-bold text-success d-flex align-items-center"><i class="bi bi-cash-stack me-2"></i>$<?php echo htmlspecialchars($row['salary']); ?></div>
                        </div>

                        <div class="mt-auto">
                            <a href="job_detail.php?id=<?php echo $row['id']; ?>" class="btn btn-custom-primary w-100 py-3">
                                View Details <i class="bi bi-arrow-right ms-2"></i>
                            </a>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <div class="col-12 text-center py-5">
                <div class="mb-3"><i class="bi bi-search text-muted opacity-25" style="font-size: 5rem;"></i></div>
                <h4 class="text-muted">No jobs found matching your search.</h4>
                <a href="index.php" class="btn btn-link text-success">Clear all filters</a>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php include('footer.php'); ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>