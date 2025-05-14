<?php
include 'db.php';
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Fetch user details
$username = $_SESSION['username'];
$user_result = $conn->query("SELECT u.*, c.name as major_name 
                            FROM users u 
                            LEFT JOIN courses c ON u.major = c.id 
                            WHERE u.username='$username'");
$user = $user_result->fetch_assoc();

$success_message = "";
$error_message = "";

// Handle profile update
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['update_profile'])) {
        $first_name = trim($_POST['first_name']);
        $last_name = trim($_POST['last_name']);
        
        // Validate input
        if (empty($first_name) || empty($last_name)) {
            $error_message = "First name and last name are required.";
        } else {
            // Update profile information
            $update_query = "UPDATE users SET 
                            first_name = '$first_name', 
                            last_name = '$last_name' 
                            WHERE username = '$username'";
            
            if ($conn->query($update_query) === TRUE) {
                $success_message = "Profile updated successfully.";
                // Refresh user data
                $user_result = $conn->query("SELECT u.*, c.name as major_name 
                                            FROM users u 
                                            LEFT JOIN courses c ON u.major = c.id 
                                            WHERE u.username='$username'");
                $user = $user_result->fetch_assoc();
            } else {
                $error_message = "Error updating profile: " . $conn->error;
            }
        }
    } elseif (isset($_POST['update_password'])) {
        $current_password = $_POST['current_password'];
        $new_password = $_POST['new_password'];
        $confirm_password = $_POST['confirm_password'];
        
        // Validate password
        if (empty($current_password) || empty($new_password) || empty($confirm_password)) {
            $error_message = "All password fields are required.";
        } elseif ($new_password !== $confirm_password) {
            $error_message = "New passwords do not match.";
        } else {
            // Verify current password
            if (password_verify($current_password, $user['password'])) {
                // Hash new password
                $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
                
                // Update password
                $update_query = "UPDATE users SET password = '$hashed_password' WHERE username = '$username'";
                
                if ($conn->query($update_query) === TRUE) {
                    $success_message = "Password updated successfully.";
                } else {
                    $error_message = "Error updating password: " . $conn->error;
                }
            } else {
                $error_message = "Current password is incorrect.";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile - University Of Sicily</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="left-sidebar.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script src="scripts.js" defer></script>
    <style>
        .profile-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            margin-bottom: 40px;
        }
        .profile-card {
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            padding: 25px;
            flex: 1;
            min-width: 300px;
            position: relative;
            overflow: hidden;
        }
        .profile-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 5px;
            height: 100%;
            background-color: var(--primary-color);
        }
        .profile-card h3 {
            margin-top: 0;
            color: var(--primary-color);
            font-size: 1.4rem;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
        }
        .profile-card h3 i {
            margin-right: 10px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-label {
            display: block;
            margin-bottom: 6px;
            font-weight: 500;
            color: #555;
        }
        .form-control {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 1rem;
            transition: border-color 0.3s;
        }
        .form-control:focus {
            border-color: var(--primary-color);
            outline: none;
        }
        .form-control[readonly] {
            background-color: #f5f5f5;
            cursor: not-allowed;
        }
        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            background-color: var(--primary-color);
            color: white;
            cursor: pointer;
            font-size: 1rem;
            transition: background-color 0.3s;
        }
        .btn:hover {
            background-color: #1a5276;
        }
        .read-only-field {
            background-color: #f8f9fa;
            padding: 12px;
            border-radius: 5px;
            border: 1px solid #e9ecef;
            margin-bottom: 15px;
        }
        .read-only-field strong {
            display: block;
            margin-bottom: 5px;
            color: #495057;
        }
        .read-only-field span {
            color: #6c757d;
        }
        .message {
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        .success-message {
            background-color: rgba(40, 167, 69, 0.1);
            border-left: 4px solid #28a745;
            color: #155724;
        }
        .error-message {
            background-color: rgba(220, 53, 69, 0.1);
            border-left: 4px solid #dc3545;
            color: #721c24;
        }
    </style>
</head>
<body>

<?php
// Include the left sidebar component
include 'LeftSidebar.php';
?>

<div class="main-content">
    <header>
        <h1><img src="unilogo.png" alt="University Logo" width="161" height="149"></h1>
        <h1>University Of Sicily</h1>
        <h3>User Profile</h3>
    </header>
    
    <main>
        <div class="welcome">
            <h2>Your Profile Information</h2>
            <p>Review and update your personal information below. Please note that some fields cannot be changed.</p>
        </div>
        
        <?php if (!empty($success_message)): ?>
            <div class="message success-message">
                <i class="fas fa-check-circle"></i> <?php echo $success_message; ?>
            </div>
        <?php endif; ?>
        
        <?php if (!empty($error_message)): ?>
            <div class="message error-message">
                <i class="fas fa-exclamation-circle"></i> <?php echo $error_message; ?>
            </div>
        <?php endif; ?>
        
        <div class="profile-container">
            <div class="profile-card">
                <h3><i class="fas fa-user"></i> Account Information</h3>
                
                <div class="read-only-field">
                    <strong>Username</strong>
                    <span><?php echo htmlspecialchars($user['username']); ?></span>
                </div>
                
                <div class="read-only-field">
                    <strong>Role</strong>
                    <span><?php echo ucfirst(htmlspecialchars($user['role'])); ?></span>
                </div>
                
                <div class="read-only-field">
                    <strong>Major</strong>
                    <span><?php echo htmlspecialchars($user['major_name'] ?? 'Not set'); ?></span>
                </div>
                
                <div class="read-only-field">
                    <strong>Age</strong>
                    <span><?php echo $user['age'] ? htmlspecialchars($user['age']) : 'Not set'; ?></span>
                </div>
            </div>
            
            <div class="profile-card">
                <h3><i class="fas fa-id-card"></i> Personal Information</h3>
                <form method="post" action="">
                    <div class="form-group">
                        <label for="first_name" class="form-label">First Name</label>
                        <input type="text" name="first_name" id="first_name" class="form-control" 
                               value="<?php echo htmlspecialchars($user['first_name'] ?? ''); ?>" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="last_name" class="form-label">Last Name</label>
                        <input type="text" name="last_name" id="last_name" class="form-control" 
                               value="<?php echo htmlspecialchars($user['last_name'] ?? ''); ?>" required>
                    </div>
                    
                    <button type="submit" name="update_profile" class="btn">Update Personal Information</button>
                </form>
            </div>
            
            <div class="profile-card">
                <h3><i class="fas fa-lock"></i> Security</h3>
                <form method="post" action="">
                    <div class="form-group">
                        <label for="current_password" class="form-label">Current Password</label>
                        <input type="password" name="current_password" id="current_password" class="form-control" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="new_password" class="form-label">New Password</label>
                        <input type="password" name="new_password" id="new_password" class="form-control" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="confirm_password" class="form-label">Confirm New Password</label>
                        <input type="password" name="confirm_password" id="confirm_password" class="form-control" required>
                    </div>
                    
                    <button type="submit" name="update_password" class="btn">Update Password</button>
                </form>
            </div>
        </div>
    </main>

    <footer>
        <p>&copy; 2025 University Of Sicily. All rights reserved.</p>
    </footer>
</div>
</body>
</html> 