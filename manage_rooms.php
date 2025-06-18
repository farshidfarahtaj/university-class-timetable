<?php
include 'db.php';
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();
}

// Handle room addition
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_room'])) {
    $name = $_POST['name'];
    $capacity = $_POST['capacity'];

    $sql = "INSERT INTO rooms (name, capacity) VALUES ('$name', '$capacity')";

    if ($conn->query($sql) === TRUE) {
        $message = "Room added successfully.";
    } else {
        $message = "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Handle room deletion
if (isset($_GET['delete'])) {
    $room_id = $_GET['delete'];

    $sql = "DELETE FROM rooms WHERE id='$room_id'";

    if ($conn->query($sql) === TRUE) {
        $message = "Room deleted successfully.";
    } else {
        $message = "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Fetch all rooms
$rooms = $conn->query("SELECT * FROM rooms");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Rooms - University Of Sicily</title>
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
        <h4>Manage Rooms</h4>
    </header>

    <main>
        <?php if (isset($message)): ?>
            <div class="message success">
                <i>✓</i> <?php echo $message; ?>
            </div>
        <?php endif; ?>

        <section>
            <div class="section-intro">
                <h2 class="section-title">Room Management</h2>
                <p class="feature-description">
                    Create and manage room resources for the University of Sicily system.
                    Rooms are used for scheduling classes and assigning to timetables.
                </p>
            </div>
            
            <div class="card room-card">
                <div class="card-header">
                    <h3>Add New Room</h3>
                    <p class="feature-description">Create a new room resource with name and capacity.</p>
                </div>
                <form method="post" class="admin-form">
                    <div class="form-group">
                        <label for="name" class="form-label">Room Name</label>
                        <input type="text" name="name" id="name" class="form-control" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="capacity" class="form-label">Capacity</label>
                        <input type="number" name="capacity" id="capacity" class="form-control" required>
                    </div>
                    
                    <input type="hidden" name="add_room" value="1">
                    <button type="submit" class="btn btn-primary">Add Room</button>
                </form>
            </div>

            <div class="card room-card">
                <div class="card-header">
                    <h3>Existing Rooms</h3>
                    <p class="feature-description">View, edit or remove room resources.</p>
                </div>
                
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>Room Name</th>
                            <th>Capacity</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if($rooms->num_rows > 0): ?>
                            <?php while ($room = $rooms->fetch_assoc()): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($room['name']); ?></td>
                                <td><?php echo $room['capacity']; ?></td>
                                <td class="action-links">
                                    <a href="edit_room.php?id=<?php echo $room['id']; ?>" class="edit" title="Edit Room">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <a href="manage_rooms.php?delete=<?php echo $room['id']; ?>" 
                                       onclick="return confirm('Are you sure you want to delete this room?');" 
                                       class="delete" title="Delete Room">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="3">No rooms found.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </section>
    </main>

    <footer class="admin-footer">
        <p>&copy; 2025 University Of Sicily. All rights reserved.</p>
    </footer>
</div>

</body>
</html>
