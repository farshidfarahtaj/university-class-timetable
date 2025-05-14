<?php
include 'db.php';
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();
}

$course_id = $_GET['id'];

// Fetch course details
$course_result = $conn->query("SELECT * FROM courses WHERE id='$course_id'");
$course = $course_result->fetch_assoc();

// Handle course modification
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $code = $_POST['code'];

    $sql = "UPDATE courses SET name='$name', code='$code' WHERE id='$course_id'";

    if ($conn->query($sql) === TRUE) {
        $message = "Course details updated successfully.";
    } else {
        $message = "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Course - University Of Sicily</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="left-sidebar.css">
    <script src="scripts.js" defer></script>
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
        <h3>Admin Portal</h3>
        <h4 style="color: #EABEBF">Edit Course</h4>
    </header>

    <main>
        <section>
            <p align="center"><div>
            <?php if (isset($message)) echo "<p>$message</p>"; ?>
            <form method="post" class="room-form">
                <h2 align="center">Update Course</h2>
                Course Name: <input type="text" name="name" value="<?php echo $course['name']; ?>" required><br>
                Course Code: <input type="text" name="code" value="<?php echo $course['code']; ?>" required><br>
                <input type="hidden" name="add_room" value="1">
                <input type="submit" class="btn1" value="Update Course">
                <a href="manage_courses.php"><input type="button" class="btn1" value="Back"></a>
            </form>
            </p></div>
        </section>
    </main>

    <footer>
        <p>&copy; 2025 University Class Timetable. All rights reserved.</p>
    </footer>
</div>
</body>
</html>