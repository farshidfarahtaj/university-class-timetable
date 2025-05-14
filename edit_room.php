<?php
include 'db.php';
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();
}

$room_id = $_GET['id'];

// Fetch room details
$room_result = $conn->query("SELECT * FROM rooms WHERE id='$room_id'");
$room = $room_result->fetch_assoc();

// Handle room modification
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $capacity = $_POST['capacity'];

    $sql = "UPDATE rooms SET name='$name', capacity='$capacity' WHERE id='$room_id'";

    if ($conn->query($sql) === TRUE) {
        $message = "Room details updated successfully.";
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
    <title>Edit Room - University Of Sicily</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="left-sidebar.css">
    <link rel="stylesheet" href="admin-style.css">
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
        <h4>Edit Room</h4>
    </header>

    <main>
        <?php if(isset($message)): ?>
            <div class="message <?php echo $message_type; ?>">
                <i><?php echo $message_type == 'success' ? '✓' : '⚠'; ?></i> <?php echo $message; ?>
            </div>
        <?php endif; ?>
        
        <section>
            <h2 class="section-title">Room Management</h2>
            
            <div class="card">
                <div class="card-header">
                    <h3>Update Room</h3>
                </div>
                <form method="post" class="admin-form">
                    <div class="form-group">
                        <label for="name" class="form-label">Room Name:</label>
                        <input id="name" name="name" type="text" class="form-control" value="<?php echo $room['name']; ?>" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="capacity" class="form-label">Capacity:</label>
                        <input type="number" id="capacity" name="capacity" class="form-control" value="<?php echo $room['capacity']; ?>" required>
                    </div>
                    
                    <div class="btn-group">
                        <button type="submit" class="btn btn-primary">Update Room</button>
                        <a href="manage_rooms.php" class="btn btn-warning">Back</a>
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