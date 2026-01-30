<?php
session_start();
require_once 'config/db.php';

// 1. Check Login
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$success_msg = "";
$error_msg = "";

// 2. Handle Form Submission
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_profile'])) {
    $new_name = trim($_POST['name']);
    $new_email = trim($_POST['email']);

    if (!empty($new_name) && !empty($new_email)) {
        // Update database
        $update_stmt = $conn->prepare("UPDATE users SET name = ?, email = ? WHERE id = ?");
        $update_stmt->bind_param("ssi", $new_name, $new_email, $user_id);
        
        if ($update_stmt->execute()) {
            $success_msg = "Profile updated successfully!";
        } else {
            $error_msg = "Error updating profile. Email might already be in use.";
        }
    } else {
        $error_msg = "All fields are required.";
    }
}

// 3. Fetch Current Data for Form Fields
$fetch_stmt = $conn->prepare("SELECT name, email, profile_pic FROM users WHERE id = ?");
$fetch_stmt->bind_param("i", $user_id);
$fetch_stmt->execute();
$user = $fetch_stmt->get_result()->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Profile</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        :root { --bg: #f4f7f6; --white: #ffffff; --green: #8cc63f; --text: #333; }
        body { font-family: 'Segoe UI', sans-serif; background: var(--bg); padding: 40px; }
        .form-container { max-width: 500px; margin: auto; background: var(--white); padding: 30px; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); }
        .header { display: flex; align-items: center; gap: 15px; margin-bottom: 25px; }
        .header a { color: var(--text); text-decoration: none; font-size: 1.2rem; }
        
        .form-group { margin-bottom: 20px; }
        label { display: block; margin-bottom: 8px; font-weight: 500; color: #666; }
        input[type="text"], input[type="email"] { 
            width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 6px; box-sizing: border-box; font-size: 1rem;
        }
        .btn-save { 
            background: var(--green); color: white; border: none; padding: 12px 25px; 
            border-radius: 6px; cursor: pointer; width: 100%; font-size: 1rem; font-weight: bold;
        }
        .alert { padding: 12px; border-radius: 6px; margin-bottom: 20px; font-size: 0.9rem; }
        .alert-success { background: #e8f8f0; color: #2ecc71; border: 1px solid #2ecc71; }
        .alert-error { background: #feebeb; color: #e74c3c; border: 1px solid #e74c3c; }
        
        .profile-preview { text-align: center; margin-bottom: 20px; }
        .profile-preview img { width: 80px; height: 80px; border-radius: 50%; object-fit: cover; border: 2px solid var(--green); }
    </style>
</head>
<body>

<div class="form-container">
    <div class="header">
        <a href="applied.php"><i class="bi bi-arrow-left"></i></a>
        <h2 style="margin:0;">Edit Profile</h2>
    </div>

    <?php if ($success_msg): ?>
        <div class="alert alert-success"><?php echo $success_msg; ?></div>
    <?php endif; ?>

    <?php if ($error_msg): ?>
        <div class="alert alert-error"><?php echo $error_msg; ?></div>
    <?php endif; ?>

    <div class="profile-preview">
        <img src="<?php echo htmlspecialchars($user['profile_pic'] ?: 'avatar.png'); ?>" alt="Profile">
    </div>

    <form method="POST" action="">
        <div class="form-group">
            <label>Full Name</label>
            <input type="text" name="name" value="<?php echo htmlspecialchars($user['name']); ?>" required>
        </div>

        <div class="form-group">
            <label>Email Address</label>
            <input type="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
        </div>

        <button type="submit" name="update_profile" class="btn-save">Save Changes</button>
    </form>
    
    <p style="text-align: center; margin-top: 20px;">
        <a href="applied.php" style="color: #888; text-decoration: none; font-size: 0.9rem;">Cancel and Go Back</a>
    </p>
</div>

</body>
</html>