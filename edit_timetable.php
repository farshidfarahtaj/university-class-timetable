<?php
include 'db.php';
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();
}

$timetable_id = $_GET['id'];

// Fetch timetable details
$timetable_result = $conn->query("SELECT * FROM timetables WHERE id='$timetable_id'");
$timetable = $timetable_result->fetch_assoc();

// Fetch all rooms and subjects for the dropdowns
$rooms = $conn->query("SELECT * FROM rooms");
$subjects = $conn->query("SELECT * FROM subjects");

// Handle timetable modification
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $room_id = $_POST['room_id'];
    $subject_id = $_POST['subject_id'];
    $day_of_week = $_POST['day_of_week'];
    $start_time = $_POST['start_time'];
    $end_time = $_POST['end_time'];

    $sql = "UPDATE timetables SET room_id='$room_id', subject_id='$subject_id', day_of_week='$day_of_week', start_time='$start_time', end_time='$end_time' WHERE id='$timetable_id'";

    if ($conn->query($sql) === TRUE) {
        $message = "Timetable details updated successfully.";
        $message_type = "success";
    } else {
        $message = "Error: " . $sql . "<br>" . $conn->error;
        $message_type = "error";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Timetable - University Of Sicily</title>
    <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="left-sidebar.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="admin-style.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="scripts.js" defer></script>
    <style>
        .user-card {
            margin-bottom: 25px;
            border-left: 4px solid var(--secondary-color);
        }
        .feature-description {
            color: #666;
            margin-bottom: 15px;
            font-size: 0.95rem;
            line-height: 1.5;
        }
        .admin-form {
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 25px;
        }
        .section-intro {
            margin-bottom: 25px;
            padding-left: 15px;
            border-left: 4px solid var(--secondary-color);
        }
        .message {
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 4px;
            background-color: rgba(46, 204, 113, 0.1);
            border-left: 4px solid #2ecc71;
            color: #1e8449;
        }
        .message.error {
            background-color: rgba(231, 76, 60, 0.1);
            border-left: 4px solid #e74c3c;
            color: #a93226;
        }
        .form-actions {
            display: flex;
            gap: 10px;
            margin-top: 20px;
        }
        .btn-group {
            display: flex;
            gap: 10px;
            margin-top: 20px;
        }
        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            text-align: center;
            font-weight: 500;
        }
        .btn-primary {
            background-color: var(--primary-color);
            color: white;
        }
        .btn-warning {
            background-color: #f39c12;
            color: white;
        }
        .form-control {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 1rem;
            transition: border-color 0.3s;
        }
        .form-label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
        }
        .form-group {
            margin-bottom: 20px;
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
        <h3>Admin Portal</h3>
        <h4>Edit Timetable</h4>
    </header>

    <main>
        <?php if(isset($message)): ?>
            <div class="message <?php echo $message_type; ?>">
                <i class="fa fa-<?php echo $message_type == 'success' ? 'check-circle' : 'exclamation-circle'; ?>"></i> <?php echo $message; ?>
            </div>
        <?php endif; ?>
        
        <section>
            <div class="section-intro">
                <h2 class="section-title">Timetable Management</h2>
                <p class="feature-description">
                    Edit the timetable details below to update class scheduling information.
                </p>
            </div>
            
            <div class="card">
                <div class="card-header">
                    <h3>Edit Timetable Details</h3>
                </div>
                <form method="post" class="admin-form">
                    <div class="form-group">
                        <label for="room_id" class="form-label">Room:</label>
                        <select name="room_id" id="room_id" class="form-control" required>
                            <?php while ($room = $rooms->fetch_assoc()): ?>
                                <option value="<?php echo $room['id']; ?>" <?php if ($room['id'] == $timetable['room_id']) echo 'selected'; ?>><?php echo $room['name']; ?></option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="subject_id" class="form-label">Subject:</label>
                        <select name="subject_id" id="subject_id" class="form-control" required>
                            <?php while ($subject = $subjects->fetch_assoc()): ?>
                                <option value="<?php echo $subject['id']; ?>" <?php if ($subject['id'] == $timetable['subject_id']) echo 'selected'; ?>><?php echo $subject['name']; ?></option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="day_of_week" class="form-label">Day of Week:</label>
                        <select name="day_of_week" id="day_of_week" class="form-control" required>
                            <option value="Monday" <?php if ($timetable['day_of_week'] == 'Monday') echo 'selected'; ?>>Monday</option>
                            <option value="Tuesday" <?php if ($timetable['day_of_week'] == 'Tuesday') echo 'selected'; ?>>Tuesday</option>
                            <option value="Wednesday" <?php if ($timetable['day_of_week'] == 'Wednesday') echo 'selected'; ?>>Wednesday</option>
                            <option value="Thursday" <?php if ($timetable['day_of_week'] == 'Thursday') echo 'selected'; ?>>Thursday</option>
                            <option value="Friday" <?php if ($timetable['day_of_week'] == 'Friday') echo 'selected'; ?>>Friday</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="start_time" class="form-label">Start Time:</label>
                        <input type="time" name="start_time" id="start_time" class="form-control" value="<?php echo $timetable['start_time']; ?>" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="end_time" class="form-label">End Time:</label>
                        <input type="time" name="end_time" id="end_time" class="form-control" value="<?php echo $timetable['end_time']; ?>" required>
                    </div>
                    
                    <div class="btn-group">
                        <button type="submit" class="btn btn-primary">Update Timetable</button>
                        <a href="manage_timetables.php" class="btn btn-warning">Back</a>
                    </div>
                </form>
            </div>
        </section>
    </main>

    <footer class="admin-footer">
        <p>&copy; 2025 University Class Timetable. All rights reserved.</p>
    </footer>
</div>
</body>
</html>