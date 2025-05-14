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
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="left-sidebar.css">
    <link rel="stylesheet" href="admin-style.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="scripts.js" defer></script>
    <style>
        body {
            font-family: 'Roboto', 'Open Sans', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f7fa;
            color: #333;
        }
        .main-content {
            max-width: 1400px;
            width: 100%;
            margin: 0 auto;
            padding: 15px;
        }
        .admin-header {
            background: linear-gradient(135deg, #2c3e50, #34495e);
            color: white;
            padding: 20px;
            margin-bottom: 30px;
            text-align: center;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }
        .admin-header h1, .admin-header h3 {
            color: white;
            margin: 10px 0;
        }
        .logo-container {
            margin-bottom: 15px;
        }
        .logo-img {
            width: 100px;
            height: auto;
            border-radius: 50%;
            background-color: white;
            padding: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        main {
            background-color: white;
            padding: 25px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
        }
        .welcome-section {
            background: linear-gradient(135deg, #2c3e50, #34495e);
            color: white;
            padding: 25px;
            border-radius: 8px;
            margin-bottom: 30px;
            position: relative;
        }
        .welcome-section h2 {
            color: white;
            margin-bottom: 15px;
        }
        .welcome-section p {
            color: rgba(255, 255, 255, 0.9);
            line-height: 1.6;
            margin-bottom: 15px;
        }
        .stat-cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 20px;
        }
        .stat-card {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.08);
            padding: 20px;
            text-align: center;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border-top: 4px solid #3498db;
        }
        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);
        }
        .stat-card:nth-child(2) {
            border-top-color: #2ecc71;
        }
        .stat-card:nth-child(3) {
            border-top-color: #f39c12;
        }
        .stat-card:nth-child(4) {
            border-top-color: #e74c3c;
        }
        .stat-icon {
            font-size: 2.5rem;
            margin-bottom: 10px;
        }
        .stat-value {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 5px;
            color: #2c3e50;
        }
        .stat-label a {
            color: #3498db;
            text-decoration: none;
            font-size: 0.9rem;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .stat-label a:hover {
            color: #e74c3c;
        }
        .admin-footer {
            text-align: center;
            padding: 20px;
            color: #7f8c8d;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.08);
        }
        @media (max-width: 768px) {
            .stat-cards {
                grid-template-columns: 1fr;
            }
            .admin-header h1 {
                font-size: 1.5rem;
            }
            .welcome-section {
                padding: 15px;
            }
        }
    </style>
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