<?php
include 'db.php';
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();
}

// Handle timetable addition
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_timetable'])) {
    $room_id = $_POST['room_id'];
    $subject_id = $_POST['subject_id'];
    $day_of_week = $_POST['day_of_week'];
    $start_time = $_POST['start_time'];
    $end_time = $_POST['end_time'];

    $sql = "INSERT INTO timetables (room_id, subject_id, day_of_week, start_time, end_time) VALUES ('$room_id', '$subject_id', '$day_of_week', '$start_time', '$end_time')";

    if ($conn->query($sql) === TRUE) {
        $message = "Timetable entry added successfully.";
        $message_type = "success";
    } else {
        $message = "Error: " . $sql . "<br>" . $conn->error;
        $message_type = "error";
    }
}

// Handle timetable deletion
if (isset($_GET['delete'])) {
    $timetable_id = $_GET['delete'];

    $sql = "DELETE FROM timetables WHERE id='$timetable_id'";

    if ($conn->query($sql) === TRUE) {
        $message = "Timetable entry deleted successfully.";
        $message_type = "success";
    } else {
        $message = "Error: " . $sql . "<br>" . $conn->error;
        $message_type = "error";
    }
}

// Fetch all rooms and subjects for the dropdowns
$rooms = $conn->query("SELECT * FROM rooms");
$subjects = $conn->query("SELECT * FROM subjects");

// Fetch all timetables
$timetables = $conn->query("SELECT timetables.id, rooms.name AS room_name, subjects.name AS subject_name, courses.name AS course_name, timetables.day_of_week, timetables.start_time, timetables.end_time FROM timetables JOIN rooms ON timetables.room_id = rooms.id JOIN subjects ON timetables.subject_id = subjects.id JOIN courses ON subjects.course_id = courses.id");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Timetables - University Of Sicily</title>
    <link rel="stylesheet" href="admin-panel.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
        <h4>Manage Timetables</h4>
    </header>

    <main>
        <?php if(isset($message)): ?>
            <div class="message <?php echo $message_type; ?>">
                <i><?php echo $message_type == 'success' ? '✓' : '⚠'; ?></i> <?php echo $message; ?>
            </div>
        <?php endif; ?>
        
        <section>
            <div class="section-intro">
                <h2 class="section-title">Timetable Management</h2>
                <p class="feature-description">
                    Create and manage class timetables for the University of Sicily.
                    Timetables are used to assign subjects to rooms at specific times.
                </p>
            </div>
            
            <div class="card timetable-card">
                <div class="card-header">
                    <h3>Add New Timetable Entry</h3>
                    <p class="feature-description">Create a new timetable entry with room, subject, day and time details.</p>
                </div>
                <form method="post" class="admin-form">
                    <div class="form-group">
                        <label for="room_id" class="form-label">Room</label>
                        <select name="room_id" id="room_id" class="form-control" required>
                            <?php 
                            // Reset the pointer to the beginning
                            $rooms->data_seek(0);
                            while ($room = $rooms->fetch_assoc()): 
                            ?>
                                <option value="<?php echo $room['id']; ?>"><?php echo $room['name']; ?></option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="subject_id" class="form-label">Subject:</label>
                        <select name="subject_id" id="subject_id" class="form-control" required>
                            <?php while ($subject = $subjects->fetch_assoc()): ?>
                                <option value="<?php echo $subject['id']; ?>"><?php echo $subject['name']; ?></option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="day_of_week" class="form-label">Day of Week:</label>
                        <select name="day_of_week" id="day_of_week" class="form-control" required>
                            <option value="Monday">Monday</option>
                            <option value="Tuesday">Tuesday</option>
                            <option value="Wednesday">Wednesday</option>
                            <option value="Thursday">Thursday</option>
                            <option value="Friday">Friday</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="start_time" class="form-label">Start Time:</label>
                        <input type="time" name="start_time" id="start_time" class="form-control" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="end_time" class="form-label">End Time:</label>
                        <input type="time" name="end_time" id="end_time" class="form-control" required>
                    </div>
                    
                    <input type="hidden" name="add_timetable" value="1">
                    <button type="submit" class="btn btn-primary">Add Timetable Entry</button>
                </form>
            </div>

            <div class="card">
                <div class="card-header">
                    <h3>Existing Timetables</h3>
                </div>
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>Room Name</th>
                            <th>Subject Name</th>
                            <th>Course Name</th>
                            <th>Day of Week</th>
                            <th>Start Time</th>
                            <th>End Time</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($timetable = $timetables->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $timetable['room_name']; ?></td>
                            <td><?php echo $timetable['subject_name']; ?></td>
                            <td><?php echo $timetable['course_name']; ?></td>
                            <td><?php echo $timetable['day_of_week']; ?></td>
                            <td><?php echo $timetable['start_time']; ?></td>
                            <td><?php echo $timetable['end_time']; ?></td>
                            <td class="actions">
                                <div class="action-links">
                                    <a href="edit_timetable.php?id=<?php echo $timetable['id']; ?>" class="edit" title="Edit">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <a href="manage_timetables.php?delete=<?php echo $timetable['id']; ?>" 
                                       onclick="return confirm('Are you sure you want to delete this timetable entry?');" 
                                       class="delete" title="Delete">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </section>
    </main>

    <footer class="admin-footer">
        <p>&copy; 2025 University Class Timetable. All rights reserved.</p>
    </footer>
</div>
</body>
</html>