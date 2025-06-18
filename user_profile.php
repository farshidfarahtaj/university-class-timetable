<?php
include 'db.php';
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Include the left sidebar component
include 'LeftSidebar.php';

// Fetch user details
$username = $_SESSION['username'];
$user_query = "SELECT * FROM users WHERE username='$username'";
$user_result = $conn->query($user_query);
$user = $user_result->fetch_assoc();

// Handle profile update
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $age = $_POST['age'];
    
    $update_query = "UPDATE users SET first_name='$first_name', last_name='$last_name', age='$age' WHERE username='$username'";
    
    if ($conn->query($update_query) === TRUE) {
        $success_message = "Profile updated successfully!";
        // Refresh user data
        $user_result = $conn->query($user_query);
        $user = $user_result->fetch_assoc();
    } else {
        $error_message = "Error updating profile: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile - University Of Sicily</title>
    <link rel="stylesheet" href="user-panel.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script src="scripts.js" defer></script>
</head>
<body>



<div class="main-content">
    <header>
        <h1><img src="unilogo.png" alt="University Logo" width="161" height="149"></h1>
        <h1>University Of Sicily</h1>
        <h3>User Profile</h3>
    </header>
    
    <main>
        <div class="profile-container">
            <div class="profile-header">
                <h2><i class="fas fa-user-circle"></i> My Profile</h2>
                <p>Manage your personal information and account settings</p>
            </div>

            <?php if (isset($success_message)): ?>
                <div class="success-message">
                    <i class="fas fa-check-circle"></i>
                    <?php echo $success_message; ?>
                </div>
            <?php endif; ?>

            <?php if (isset($error_message)): ?>
                <div class="error-message">
                    <i class="fas fa-exclamation-circle"></i>
                    <?php echo $error_message; ?>
                </div>
            <?php endif; ?>

            <form method="post" class="profile-form">
                <div class="form-row">
                    <div class="form-group">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" id="username" class="form-control" value="<?php echo htmlspecialchars($user['username']); ?>" readonly>
                    </div>
                    
                    <div class="form-group">
                        <label for="role" class="form-label">Role</label>
                        <input type="text" id="role" class="form-control" value="<?php echo ucfirst($user['role']); ?>" readonly>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="first_name" class="form-label">First Name</label>
                        <input type="text" id="first_name" name="first_name" class="form-control" value="<?php echo htmlspecialchars($user['first_name']); ?>" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="last_name" class="form-label">Last Name</label>
                        <input type="text" id="last_name" name="last_name" class="form-control" value="<?php echo htmlspecialchars($user['last_name']); ?>" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="age" class="form-label">Age</label>
                        <input type="number" id="age" name="age" class="form-control" value="<?php echo $user['age']; ?>" min="16" max="100" required>
                    </div>
                </div>

                <div class="form-actions" style="display: flex; flex-direction: column; align-items: flex-start; gap: 10px;">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Update Profile
                    </button>
                    <a href="student_dashboard.php" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Back to Dashboard
                    </a>
                </div>
            </form>
        </div>
    </main>

    <footer>
        <p>&copy; 2025 University Class Timetable. All rights reserved.</p>
    </footer>
</div>

</body>
</html> 
