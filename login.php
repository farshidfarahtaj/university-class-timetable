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
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="left-sidebar.css">
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

<style>
/* Login page specific styles */
.header-content {
    position: relative;
    z-index: 2;
    width: 100%;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
}

.auth-container {
    display: flex;
    flex-direction: row;
    gap: 30px;
    align-items: stretch;
}

.auth-card {
    flex: 1;
    background: white;
    border-radius: 12px;
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
    overflow: hidden;
    max-width: 450px;
    transition: transform 0.3s ease;
    transform: translateZ(0);
    backface-visibility: hidden;
    -webkit-backface-visibility: hidden;
}

.auth-card:hover {
    transform: translateY(-5px);
}

.auth-info {
    flex: 1;
    padding: 30px;
    background: linear-gradient(135deg, var(--primary-color), #34495e);
    color: white;
    border-radius: 12px;
    display: flex;
    flex-direction: column;
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
    position: relative;
    overflow: hidden;
}

.auth-info::before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" viewBox="0 0 100 100"><rect width="100" height="100" fill="rgba(255,255,255,0.03)"/></svg>');
    opacity: 0.4;
    z-index: 0;
}

.auth-header {
    padding: 30px;
    text-align: center;
    background: linear-gradient(135deg, var(--primary-color), #34495e);
    color: white;
    position: relative;
}

.auth-header::after {
    content: "";
    position: absolute;
    bottom: 0;
    left: 10%;
    right: 10%;
    height: 1px;
    background: rgba(255, 255, 255, 0.1);
}

.auth-icon {
    font-size: 3.5rem;
    margin-bottom: 15px;
    color: rgba(255, 255, 255, 0.9);
    text-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
}

.auth-header h2 {
    color: white;
    margin-bottom: 10px;
    font-weight: 700;
}

.auth-header p {
    color: rgba(255, 255, 255, 0.8);
    margin-bottom: 0;
}

.error-message {
    background-color: #e74c3c;
    color: white;
    padding: 12px 15px;
    margin: 15px;
    border-radius: 6px;
    display: flex;
    align-items: center;
    gap: 10px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.error-message i {
    font-size: 1.2rem;
}

.auth-form {
    padding: 30px;
}

.auth-form .input-container {
    margin-bottom: 25px;
}

.auth-form .input-field {
    padding: 14px 14px 14px 50px;
    border-radius: 6px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
}

.auth-form .icon {
    left: 18px;
    font-size: 1.1rem;
}

.auth-form .btn {
    margin-top: 10px;
    padding: 14px;
    border-radius: 6px;
    font-weight: 500;
    letter-spacing: 0.5px;
}

.auth-links {
    text-align: center;
    margin-top: 25px;
    font-size: 0.95rem;
}

.auth-links a {
    color: var(--secondary-color);
    font-weight: 500;
    position: relative;
}

.auth-links a::after {
    content: "";
    position: absolute;
    bottom: -2px;
    left: 0;
    width: 100%;
    height: 1px;
    background-color: var(--secondary-color);
    transform: scaleX(0);
    transition: transform 0.3s ease;
    transform-origin: right;
}

.auth-links a:hover::after {
    transform: scaleX(1);
    transform-origin: left;
}

.info-cards {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 20px;
    margin-top: 25px;
    position: relative;
    z-index: 1;
}

.info-card {
    background: rgba(255, 255, 255, 0.1);
    border-radius: 10px;
    padding: 25px;
    text-align: center;
    transition: transform 0.3s ease;
    backdrop-filter: blur(5px);
    -webkit-backdrop-filter: blur(5px);
    border: 1px solid rgba(255, 255, 255, 0.1);
}

.info-card:hover {
    transform: translateY(-5px);
    background: rgba(255, 255, 255, 0.15);
}

.info-card i {
    font-size: 2.2rem;
    margin-bottom: 15px;
    color: rgba(255, 255, 255, 0.9);
}

.info-card h4 {
    color: white;
    margin-bottom: 12px;
    font-weight: 600;
}

.info-card p {
    font-size: 0.95rem;
    color: rgba(255, 255, 255, 0.8);
    line-height: 1.5;
}

.auth-info h3 {
    color: white;
    margin-bottom: 15px;
    font-weight: 600;
    position: relative;
    z-index: 1;
}

.auth-info > p {
    color: rgba(255, 255, 255, 0.9);
    margin-bottom: 25px;
    position: relative;
    z-index: 1;
}

@media (max-width: 992px) {
    .auth-container {
        flex-direction: column;
    }
    
    .auth-card {
        max-width: 100%;
    }
}

@media (max-width: 576px) {
    .info-cards {
        grid-template-columns: 1fr;
    }
    
    .auth-header, .auth-form {
        padding: 20px;
    }
    
    .auth-form .input-field {
        padding: 12px 12px 12px 45px;
    }
    
    .auth-form .btn {
        padding: 12px;
    }
}

/* Fix for backdrop-filter in Safari */
@supports not (backdrop-filter: blur(5px)) {
    .info-card {
        background: rgba(255, 255, 255, 0.15);
    }
}
</style>

</body>
</html>