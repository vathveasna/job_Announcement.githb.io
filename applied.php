<?php
session_start();
require_once 'config/db.php';

// 1. Check Login
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// 2. Handle Delete Request (Securely using Prepared Statements)
if (isset($_GET['delete_id'])) {
    $delete_id = intval($_GET['delete_id']);
    $stmt = $conn->prepare("DELETE FROM jobs_applied WHERE id = ? AND user_id = ?");
    $stmt->bind_param("ii", $delete_id, $user_id);
    
    if ($stmt->execute()) {
        header("Location: applied.php?msg=removed");
        exit();
    }
}

// 3. Fetch User Profile Data
$user_stmt = $conn->prepare("SELECT name, email, profile_pic FROM users WHERE id = ?");
$user_stmt->bind_param("i", $user_id);
$user_stmt->execute();
$user_data = $user_stmt->get_result()->fetch_assoc();

// Fallbacks for profile display
$display_name = !empty($user_data['name']) ? $user_data['name'] : "User";
$display_email = !empty($user_data['email']) ? $user_data['email'] : "Email not set";
$display_pic = !empty($user_data['profile_pic']) ? $user_data['profile_pic'] : "avatar.png";

// 4. Fetch Applied Jobs for this User
$job_stmt = $conn->prepare("SELECT * FROM jobs_applied WHERE user_id = ? ORDER BY date_created DESC");
$job_stmt->bind_param("i", $user_id);
$job_stmt->execute();
$result = $job_stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jobs Applied | Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
   <link rel="stylesheet" href="css/applied.css">
</head>
<body>

<div class="container">
    <div class="sidebar">
        <div class="profile-card">
            <img src="<?php echo htmlspecialchars($display_pic); ?>" alt="Profile Picture">
            <h3><?php echo htmlspecialchars($display_name); ?></h3>
            <p><?php echo htmlspecialchars($display_email); ?></p>
            <a href="edit_profile.php" style="text-decoration: none;">
                <button style="background: var(--green); color: white; border: none; padding: 10px; border-radius: 6px; width: 100%; cursor: pointer; font-weight: 500;">Edit Profile</button>
            </a>
        </div>
        
        <div class="nav-menu">
            <a href="applied.php" class="nav-item active-nav"><i class="bi bi-briefcase"></i> Jobs Applied</a>
            <a href="find_job.php" class="nav-item"><i class="bi bi-search"></i> Browse Jobs</a>
            <a href="settings.php" class="nav-item"><i class="bi bi-gear"></i> Settings</a>
            <a href="logout.php" class="nav-item" style="color: var(--danger);"><i class="bi bi-box-arrow-right"></i> Logout</a>
        </div>
    </div>

    <div class="main-content">
        <h2>Jobs Applied</h2>
        
        <?php if (isset($_GET['msg']) && $_GET['msg'] == 'removed'): ?>
            <div style="background: #d4edda; color: #155724; padding: 10px; border-radius: 5px; margin-bottom: 20px; font-size: 0.9rem;">
                Application successfully removed.
            </div>
        <?php endif; ?>

        <table>
            <thead>
                <tr>
                    <th>Job Title</th>
                    <th>Date Applied</th>
                    <th>Applicants</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result->num_rows > 0): ?>
                    <?php while($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td>
                            <div style="font-weight:600; color: #333;"><?php echo htmlspecialchars($row['title']); ?></div>
                            <div style="font-size:0.8rem; color:#888; margin-top:3px;">
                                <?php echo htmlspecialchars($row['job_type']); ?> • <?php echo htmlspecialchars($row['location']); ?>
                            </div>
                        </td>
                        <td style="font-size: 0.9rem; color: #555;">
                            <?php echo date('d M, Y', strtotime($row['date_created'])); ?>
                        </td>
                        <td style="font-size: 0.9rem;">
                            <i class="bi bi-people" style="margin-right: 5px;"></i> <?php echo $row['applicants_count']; ?>
                        </td>
                        <td>
                            <span class="status <?php echo $row['status']; ?>">
                                <?php echo $row['status']; ?>
                            </span>
                        </td>
                        <td class="action-cell">
                            <button class="menu-btn" onclick="toggleMenu(event, <?php echo $row['id']; ?>)">⋮</button>
                            <div id="menu-<?php echo $row['id']; ?>" class="dropdown-menu">
                                <a href="job_detail.php?id=<?php echo $row['id']; ?>"><i class="bi bi-eye"></i> View Detail</a>
                                <a href="javascript:void(0)" onclick="confirmDelete(<?php echo $row['id']; ?>)" style="color: var(--danger);">
                                    <i class="bi bi-trash"></i> Remove
                                </a>
                            </div>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" style="text-align:center; padding: 60px 20px; color: #aaa;">
                            <i class="bi bi-inbox" style="font-size: 3rem; display: block; margin-bottom: 10px;"></i>
                            You haven't applied for any jobs yet. <br>
                            <a href="find_job.php" style="color: var(--green); text-decoration: none; font-weight: bold;">Browse jobs now</a>
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<script>
    // Toggle dropdown menu
    function toggleMenu(event, id) {
        event.stopPropagation();
        const currentMenu = document.getElementById('menu-' + id);
        
        // Close all other menus
        document.querySelectorAll('.dropdown-menu').forEach(menu => {
            if(menu !== currentMenu) menu.classList.remove('show');
        });
        
        currentMenu.classList.toggle('show');
    }

    // Close menu if clicking anywhere on the screen
    window.onclick = function() {
        document.querySelectorAll('.dropdown-menu').forEach(menu => {
            menu.classList.remove('show');
        });
    }

    // Deletion confirmation
    function confirmDelete(id) {
        if (confirm("Are you sure you want to remove this job application from your list?")) {
            window.location.href = "applied.php?delete_id=" + id;
        }
    }
</script>

</body>
</html>