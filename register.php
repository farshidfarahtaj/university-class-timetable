<?php
include 'db.php';

// Fetch available courses for majors
$majors_query = "SELECT id, name FROM courses ORDER BY name";
$majors_result = $conn->query($majors_query);

$registration_success = false;
$error_message = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $retype_password = $_POST['retype_password'];
    $major = isset($_POST['major']) ? (int)$_POST['major'] : NULL;
    
    // Get new profile fields
    $first_name = isset($_POST['first_name']) ? trim($_POST['first_name']) : '';
    $last_name = isset($_POST['last_name']) ? trim($_POST['last_name']) : '';
    $age = isset($_POST['age']) ? (int)$_POST['age'] : NULL;
    
    // Validate new fields
    if (empty($first_name)) {
        $error_message = "First name is required.";
    } elseif (empty($last_name)) {
        $error_message = "Last name is required.";
    } elseif (empty($age) || !is_numeric($age)) {
        $error_message = "Valid age is required.";
    } elseif ($age < 16 || $age > 100) {
        $error_message = "Age must be between 16 and 100.";
    }

    // Validate major selection if provided
    if (empty($error_message) && !empty($major)) {
        $major_check = $conn->query("SELECT id FROM courses WHERE id = $major");
        if ($major_check->num_rows === 0) {
            $error_message = "Invalid major selected. Please try again.";
        }
    }

    if (empty($error_message)) {
        if ($password !== $retype_password) {
            $error_message = "Passwords do not match. Please try again.";
        } else {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $role = 'student';

            $sql = "INSERT INTO users (username, first_name, last_name, age, password, role, major) 
                    VALUES ('$username', '$first_name', '$last_name', $age, '$hashed_password', '$role', " . ($major ? $major : "NULL") . ")";

            if ($conn->query($sql) === TRUE) {
                $registration_success = true;
            } else {
                $error_message = "Error: " . $conn->error;
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Register for University of Sicily student portal">
    <meta name="theme-color" content="#2c3e50">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <title>Register - University Of Sicily</title>
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
            <p class="tagline">Student Registration Portal</p>
        </div>
    </header>

    <main class="auth-container">
        <div class="auth-card">
            <div class="auth-header">
                <i class="fas fa-user-plus auth-icon"></i>
                <h2>Create Your Account</h2>
                <p>Join our academic community</p>
            </div>
            
            <?php if ($registration_success): ?>
                <div class="success-message">
                    <i class="fas fa-check-circle"></i>
                    Registration successful! You can now <a href="login.php">log in</a> to your account.
                </div>
            <?php endif; ?>
            
            <?php if ($error_message): ?>
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
                    <i class="fas fa-user-tag icon"></i>
                    <input class="input-field" type="text" placeholder="First Name" name="first_name" required>
                </div>
                
                <div class="input-container">
                    <i class="fas fa-user-tag icon"></i>
                    <input class="input-field" type="text" placeholder="Last Name" name="last_name" required>
                </div>
                
                <div class="input-container">
                    <i class="fas fa-birthday-cake icon"></i>
                    <input class="input-field" type="number" min="16" max="100" placeholder="Age" name="age" required>
                </div>
                
                <div class="input-container">
                    <i class="fas fa-lock icon"></i>
                    <input class="input-field" type="password" placeholder="Password" name="password" required>
                </div>
                
                <div class="input-container">
                    <i class="fas fa-lock icon"></i>
                    <input class="input-field" type="password" placeholder="Confirm Password" name="retype_password" required>
                </div>
                
                <div class="input-container">
                    <i class="fas fa-graduation-cap icon"></i>
                    <select class="input-field" name="major" required>
                        <option value="" disabled selected>Select Your Major</option>
                        <?php while($major = $majors_result->fetch_assoc()): ?>
                            <option value="<?php echo $major['id']; ?>"><?php echo htmlspecialchars($major['name']); ?></option>
                        <?php endwhile; ?>
                    </select>
                </div>
                
                <div class="terms-container">
                    <label class="terms-label">
                        <input type="checkbox" required>
                        <span>I agree to the <a href="#">Terms of Service</a> and <a href="#">Privacy Policy</a></span>
                    </label>
                </div>
                
                <button type="submit" class="btn">
                    <i class="fas fa-user-plus"></i> Create Account
                </button>
                
                <div class="auth-links">
                    <p>Already have an account? <a href="login.php">Log in</a></p>
                </div>
            </form>
        </div>
        
        <div class="auth-info">
            <h3>Benefits of Joining Our University</h3>
            <p>By creating an account, you'll gain access to a wide range of university services and resources.</p>
            
            <div class="info-cards">
                <div class="info-card">
                    <i class="fas fa-book"></i>
                    <h4>Access Resources</h4>
                    <p>Get access to our extensive digital library and course materials.</p>
                </div>
                
                <div class="info-card">
                    <i class="fas fa-calendar-alt"></i>
                    <h4>View Timetables</h4>
                    <p>Check your class schedules, room assignments, and important dates.</p>
                </div>
                
                <div class="info-card">
                    <i class="fas fa-users"></i>
                    <h4>Join Community</h4>
                    <p>Connect with fellow students, professors, and university staff.</p>
                </div>
            </div>
            
            <div class="registration-steps">
                <h4><i class="fas fa-tasks"></i> Registration Process</h4>
                <ol class="steps-list">
                    <li>Complete the online registration form</li>
                    <li>Verify your email address</li>
                    <li>Set up your student profile</li>
                    <li>Access your personal dashboard</li>
                </ol>
            </div>
        </div>
    </main>

    <footer>
        <div class="footer-content">
            <div class="footer-section">
                <h4>Help & Support</h4>
                <p><i class="fas fa-question-circle"></i> Need help with registration?</p>
                <p><i class="fas fa-envelope"></i> Contact student services</p>
            </div>
            <div class="footer-section">
                <h4>Registration Policy</h4>
                <p><i class="fas fa-shield-alt"></i> Your information is secured and encrypted</p>
                <p><i class="fas fa-user-secret"></i> We respect your privacy</p>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2025 University Of Sicily. All rights reserved.</p>
        </div>
    </footer>
</div>

</body>
</html>