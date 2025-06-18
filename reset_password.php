<?php
include 'db.php';
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();
}

$user_id = isset($_GET['id']) ? $_GET['id'] : 0;
$redirect_page = isset($_GET['redirect']) ? $_GET['redirect'] : 'manage_users.php';

// Fetch user details first
$user_result = $conn->query("SELECT * FROM users WHERE id='$user_id'");

if ($user_result->num_rows === 0) {
    $_SESSION['message'] = "User not found.";
    header("Location: $redirect_page");
    exit();
}

$user = $user_result->fetch_assoc();
$user_role = $user['role'];
$username = $user['username'];

// Handle password reset
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $password = $_POST['password'];
    $retype_password = $_POST['retype_password'];
    
    // Check if passwords match
    if ($password !== $retype_password) {
        $message = "Passwords do not match.";
    } else {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        
        $sql = "UPDATE users SET password='$hashed_password' WHERE id='$user_id'";
        
        if ($conn->query($sql) === TRUE) {
            $_SESSION['message'] = "Password reset successful for user: $username.";
            header("Location: $redirect_page");
            exit();
        } else {
            $message = "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password - University Of Sicily</title>
    <link rel="stylesheet" href="admin-panel.css">
    <script src="scripts.js" defer></script>
</head>
<body>

<?php
// Include the left sidebar component
include 'LeftSidebar.php';
?>

<div class="main-content">
    <header class="admin-header">
        <div class="logo-container">
            <img src="unilogo.png" alt="University Logo" class="logo-img" width="120" height="120">
        </div>
        <h1>University Of Sicily</h1>
        <h3>Admin Portal</h3>
        <h4>Reset Password</h4>
    </header>

    <main>
        <?php if (isset($message)): ?>
            <div class="message">
                <?php echo $message; ?>
            </div>
        <?php endif; ?>

        <section>
            <div class="section-intro">
                <h2 class="section-title">Reset User Password</h2>
                <p class="feature-description">
                    Reset the password for user: <strong><?php echo htmlspecialchars($username); ?></strong> (<?php echo ucfirst($user_role); ?>).
                </p>
            </div>

            <div class="card user-card">
                <div class="card-header">
                    <h3>Enter New Password</h3>
                    <p class="feature-description">Create a new secure password for this account.</p>
                </div>
                
                <div class="user-detail">
                    <p><strong>User ID:</strong> <?php echo $user_id; ?></p>
                    <p><strong>Username:</strong> <?php echo htmlspecialchars($username); ?></p>
                    <p><strong>Role:</strong> <?php echo ucfirst($user_role); ?></p>
                </div>
                
                <form method="post" class="admin-form">
                    <div class="form-group">
                        <label for="password" class="form-label">New Password</label>
                        <input type="password" name="password" id="password" class="form-control" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="retype_password" class="form-label">Confirm New Password</label>
                        <input type="password" name="retype_password" id="retype_password" class="form-control" required>
                        <div class="password-rules">
                            <strong>Password should:</strong>
                            <ul>
                                <li>Be at least 8 characters long</li>
                                <li>Include uppercase and lowercase letters</li>
                                <li>Include at least one number</li>
                                <li>Include at least one special character</li>
                            </ul>
                        </div>
                    </div>
                    
                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary">Reset Password</button>
                        <a href="<?php echo $redirect_page; ?>" class="btn btn-back">Cancel</a>
                    </div>
                </form>
            </div>
        </section>
    </main>

    <footer class="admin-footer">
        <p>&copy; 2025 University Of Sicily. All rights reserved.</p>
    </footer>
</div>
</body>
</html> 