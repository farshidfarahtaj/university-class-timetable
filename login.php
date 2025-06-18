<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username='$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            session_start();
            $_SESSION['username'] = $username;
            $_SESSION['role'] = $row['role'];
            $_SESSION['user_id'] = $row['id'];
            // Store major information in session if it's a student
            if ($row['role'] == 'student') {
                $_SESSION['major_id'] = $row['major'];
                // Get major name for display purposes
                if (!empty($row['major'])) {
                    $major_query = "SELECT name FROM courses WHERE id = " . $row['major'];
                    $major_result = $conn->query($major_query);
                    if ($major_result->num_rows > 0) {
                        $major_row = $major_result->fetch_assoc();
                        $_SESSION['major_name'] = $major_row['name'];
                    }
                }
            }
            
            if ($row['role'] == 'admin') {
                header("Location: admin_dashboard.php");
            } else {
                header("Location: student_dashboard.php");
            }
        } else {
            $error_message = "Invalid password. Please try again.";
        }
    } else {
        $error_message = "No user found with that username.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Login to University of Sicily student portal">
    <meta name="theme-color" content="#2c3e50">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <title>Login - University Of Sicily</title>
    <link rel="stylesheet" href="main-pages.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script src="scripts.js" defer></script>
</head>
<body>

<?php
// Include the left sidebar component
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include 'LeftSidebar.php';
?>

<div class="main-content chrome-fix">
    <header>
        <div class="header-content">
            <img src="unilogo.png" alt="University of Sicily Logo" class="logo-img">
            <h1>University Of Sicily</h1>
            <p class="tagline">Student & Faculty Portal</p>
        </div>
    </header>
    
    <main class="auth-container">
        <div class="auth-card">
            <div class="auth-header">
                <i class="fas fa-user-circle auth-icon"></i>
                <h2>Log In to Your Account</h2>
                <p>Enter your credentials to access the portal</p>
            </div>
            
            <?php if (isset($error_message)): ?>
                <div class="error-message">
                    <i class="fas fa-exclamation-circle"></i>
                    <?php echo $error_message; ?>
                </div>
            <?php endif; ?>
            
            <form method="post" class="auth-form">
                <div class="input-container">
                    <i class="fas fa-user icon"></i>
                    <input class="input-field" type="text" placeholder="Username" name="username" required>
                </div>

                <div class="input-container">
                    <i class="fas fa-lock icon"></i>
                    <input class="input-field" type="password" placeholder="Password" name="password" required>
                </div>

                <button type="submit" class="btn">
                    <i class="fas fa-sign-in-alt"></i> Login
                </button>
                
                <div class="auth-links">
                    <p>Don't have an account? <a href="register.php">Register now</a></p>
                </div>
            </form>
        </div>
        
        <div class="auth-info">
            <h3>Welcome to the University Portal</h3>
            <p>Access your courses, timetables, and university resources with your student or faculty account.</p>
            
            <div class="info-cards">
                <div class="info-card">
                    <i class="fas fa-graduation-cap"></i>
                    <h4>Students</h4>
                    <p>View your timetable, check grades, and access course materials.</p>
                </div>
                
                <div class="info-card">
                    <i class="fas fa-chalkboard-teacher"></i>
                    <h4>Faculty</h4>
                    <p>Manage courses, update class schedules, and communicate with students.</p>
                </div>
                
                <div class="info-card">
                    <i class="fas fa-cog"></i>
                    <h4>Administrators</h4>
                    <p>Access system settings, manage users, and configure university resources.</p>
                </div>
            </div>
        </div>
    </main>

    <footer>
        <div class="footer-content">
            <div class="footer-section">
                <h4>Help & Support</h4>
                <p><i class="fas fa-question-circle"></i> Forgot your password?</p>
                <p><i class="fas fa-envelope"></i> Contact IT support</p>
            </div>
            <div class="footer-section">
                <h4>Security</h4>
                <p><i class="fas fa-shield-alt"></i> Your connection is secure</p>
                <p><i class="fas fa-lock"></i> We value your privacy</p>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2025 University Of Sicily. All rights reserved.</p>
        </div>
    </footer>
</div>

</body>
</html>