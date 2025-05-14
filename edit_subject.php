<?php
include 'db.php';
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();
}

$subject_id = $_GET['id'];

// Fetch subject details
$subject_result = $conn->query("SELECT * FROM subjects WHERE id='$subject_id'");
$subject = $subject_result->fetch_assoc();

// Fetch all courses for the dropdown
$courses = $conn->query("SELECT * FROM courses");

// Handle subject modification
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $course_id = $_POST['course_id'];

    $sql = "UPDATE subjects SET name='$name', course_id='$course_id' WHERE id='$subject_id'";

    if ($conn->query($sql) === TRUE) {
        $message = "Subject details updated successfully.";
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
    <title>Edit Subject - University Of Sicily</title>
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
        <h4 style="color: #EABEBF">Edit Subject</h4>
    </header>

    <main>
        <section>
            <p align="center"><div>
            <?php if (isset($message)) echo "<p>$message</p>"; ?>
        
        
            <form method="post" class="room-form">
                <h2 align="center">Update Subject</h2>
                Subject Name: <input type="text" name="name" value="<?php echo htmlspecialchars($subject['name']); ?>" required><br>
                Course:  
                <select name="course_id" required>
                    <?php while ($course = $courses->fetch_assoc()): ?>
                    <option value="<?php echo $course['id']; ?>" <?php if ($course['id'] == $subject['course_id']) echo 'selected'; ?>><?php echo $course['name']; ?></option>
                    <?php endwhile; ?>
                </select><br>
                <input type="submit" class="btn1" value="Update Subject">
                <a href="manage_subjects.php"><input type="button" class="btn1" value="Back"></a>
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