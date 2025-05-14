<?php
include 'db.php';
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] != 'student') {
    header("Location: login.php");
    exit();
}

// Check if student has selected a major
$has_major = isset($_SESSION['major_id']) && !empty($_SESSION['major_id']);
$major_id = $has_major ? $_SESSION['major_id'] : 0;
$major_name = isset($_SESSION['major_name']) ? $_SESSION['major_name'] : 'Not Selected';

// Get query parameter for viewing all timetables (admin can override for testing)
$view_all = isset($_GET['view_all']) && $_GET['view_all'] == 1;

// Fetch timetables based on major or all if no major is selected or view_all is set
if ($has_major && !$view_all) {
    $sql = "SELECT subjects.name AS subject_name, rooms.name AS room_name, 
            courses.name AS course_name, courses.code AS course_code,
            timetables.day_of_week, timetables.start_time, timetables.end_time 
            FROM timetables 
            JOIN subjects ON timetables.subject_id = subjects.id 
            JOIN rooms ON timetables.room_id = rooms.id 
            JOIN courses ON subjects.course_id = courses.id
            WHERE courses.id = $major_id
            ORDER BY timetables.day_of_week, timetables.start_time";
} else {
    $sql = "SELECT subjects.name AS subject_name, rooms.name AS room_name, 
            courses.name AS course_name, courses.code AS course_code,
            timetables.day_of_week, timetables.start_time, timetables.end_time 
            FROM timetables 
            JOIN subjects ON timetables.subject_id = subjects.id 
            JOIN rooms ON timetables.room_id = rooms.id 
            JOIN courses ON subjects.course_id = courses.id
            ORDER BY timetables.day_of_week, timetables.start_time";
}

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Timetable - University Of Sicily</title>
    <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="left-sidebar.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script src="scripts.js" defer></script>
    <style>
        .timetable-card {
            margin-bottom: 25px;
            border-left: 4px solid #3498db;
        }
        .major-info {
            background-color: #f8f9fa;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            border-left: 4px solid #3498db;
        }
        .major-name {
            font-weight: bold;
            color: #2c3e50;
        }
        .timetable-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        .timetable-table th {
            background-color: #2c3e50;
            color: white;
            padding: 12px 15px;
            text-align: left;
        }
        .timetable-table td {
            padding: 10px 15px;
            border-bottom: 1px solid #eee;
        }
        .timetable-table tr:hover {
            background-color: #f5f7fa;
        }
        .empty-message {
            padding: 20px;
            text-align: center;
            background-color: #f8f9fa;
            border-radius: 8px;
            margin-top: 20px;
        }
        .update-major {
            display: inline-block;
            margin-top: 10px;
            text-decoration: none;
            color: #3498db;
        }
    </style>
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
        <h3>Student Portal</h3>
        <h4>Class Timetable</h4>
    </header>

    <main>
        <div class="major-info">
            <h3>Your Major: <span class="major-name"><?php echo htmlspecialchars($major_name); ?></span></h3>
            <?php if (!$has_major): ?>
                <p>You haven't selected a major yet. Contact an administrator to update your profile.</p>
            <?php else: ?>
                <p>Below is the class schedule for your major. Classes are organized by day and time.</p>
            <?php endif; ?>
            
            <?php if ($view_all): ?>
                <p><strong>Note:</strong> You are currently viewing all classes across all majors.</p>
                <a href="view_timetable.php" class="update-major"><i class="fas fa-filter"></i> View Only My Major</a>
            <?php elseif ($has_major): ?>
                <a href="view_timetable.php?view_all=1" class="update-major"><i class="fas fa-th"></i> View All Majors</a>
            <?php endif; ?>
        </div>

        <?php if ($result->num_rows > 0): ?>
            <table class="timetable-table">
                <thead>
                    <tr>
                        <th>Subject</th>
                        <th>Course</th>
                        <th>Room</th>
                        <th>Day of Week</th>
                        <th>Start Time</th>
                        <th>End Time</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['subject_name']); ?></td>
                        <td><?php echo htmlspecialchars($row['course_name']); ?> (<?php echo htmlspecialchars($row['course_code']); ?>)</td>
                        <td><?php echo htmlspecialchars($row['room_name']); ?></td>
                        <td><?php echo htmlspecialchars($row['day_of_week']); ?></td>
                        <td><?php echo htmlspecialchars($row['start_time']); ?></td>
                        <td><?php echo htmlspecialchars($row['end_time']); ?></td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <div class="empty-message">
                <i class="fas fa-calendar-times fa-3x" style="color: #95a5a6; margin-bottom: 15px;"></i>
                <h3>No Classes Found</h3>
                <p>There are no classes scheduled for your major at this time.</p>
                <?php if (!$view_all && $has_major): ?>
                    <a href="view_timetable.php?view_all=1" class="update-major"><i class="fas fa-th"></i> View All Majors</a>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </main>

    <footer class="admin-footer">
        <p>&copy; 2025 University Of Sicily. All rights reserved.</p>
    </footer>
</div>
</body>
</html>