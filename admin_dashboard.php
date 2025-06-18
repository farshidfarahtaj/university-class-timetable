<?php
include 'db.php';
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();
}

// Include the left sidebar component
include 'LeftSidebar.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - University Of Sicily</title>
    <link rel="stylesheet" href="admin-panel.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="scripts.js" defer></script>
</head>
<body>

<div class="main-content">
    <header class="admin-header">
        <div class="logo-container">
            <img src="unilogo.png" alt="University Logo" class="logo-img" width="120" height="120">
        </div>
        <h1>University Of Sicily</h1>
        <h3>Admin Portal</h3>
    </header>	
	
    <main>
        <section class="welcome-section">
            <h2>Welcome, <?php echo $_SESSION['username']; ?></h2>
            <p><strong>Welcome to Your Admin Portal!</strong></p>
            <p>We're excited to have you on board. This is your hub for managing and overseeing all aspects of the system. From user management to content control and beyond, you have the tools to ensure everything runs smoothly. Your role is crucial in maintaining the integrity and efficiency of the platform, and we're here to support you every step of the way.</p>
            <p>Take charge, explore the features, and make the most of your admin portal experience!</p>
        </section>

        <section class="stat-cards">
            <div class="stat-card">
                <div class="stat-icon">👥</div>
                <div class="stat-value">User Management</div>
                <div class="stat-label"><a href="manage_users.php">Manage Users</a></div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">📚</div>
                <div class="stat-value">Course Management</div>
                <div class="stat-label"><a href="manage_courses.php">Manage Courses</a></div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">📅</div>
                <div class="stat-value">Timetable Management</div>
                <div class="stat-label"><a href="manage_timetables.php">Manage Timetables</a></div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">🏢</div>
                <div class="stat-value">Room Management</div>
                <div class="stat-label"><a href="manage_rooms.php">Manage Rooms</a></div>
            </div>
        </section>
    </main>

    <footer class="admin-footer">
        <p>&copy; 2025 University Class Timetable. All rights reserved.</p>
    </footer>
</div>

</body>
</html>