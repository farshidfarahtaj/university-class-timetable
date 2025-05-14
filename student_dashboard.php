<?php
include 'db.php';
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] != 'student') {
    header("Location: login.php");
}

// Fetch user details to display name
$username = $_SESSION['username'];
$user_query = "SELECT first_name, last_name FROM users WHERE username='$username'";
$user_result = $conn->query($user_query);
$user = $user_result->fetch_assoc();

// Format the name for display
$display_name = $username;
if (!empty($user['first_name']) && !empty($user['last_name'])) {
    $display_name = $user['first_name'] . ' ' . $user['last_name'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard - University Of Sicily</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="left-sidebar.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script src="scripts.js" defer></script>
    <style>
        .profile-link {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background-color: var(--primary-color);
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s;
        }
        .profile-link:hover {
            background-color: #1a5276;
        }
        .profile-link i {
            margin-right: 8px;
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
        <h3>Student Portal</h3>
    </header>
    
    <main>
        <div class="welcome">
            <h2>Welcome, <?php echo htmlspecialchars($display_name); ?></h2>
            <p>We are thrilled to have you here. This is your personal space to access all the tools, resources, and information you need to succeed in your academic journey. Stay up to date with your courses, assignments, grades, and more. We're here to support you every step of the way.
            </p>
            <p>&nbsp;</p>
            <p>Feel free to explore and make the most of your student portal experience!</p>
            
            <a href="user_profile.php" class="profile-link">
                <i class="fas fa-user-circle"></i> View and Edit Your Profile
            </a>
        </div>
    </main>

    <footer>
        <p>&copy; 2025 University Class Timetable. All rights reserved.</p>
    </footer>
</div>
</body>
</html>