<?php
include 'db.php';
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();
}

// Handle subject addition
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_subject'])) {
    $name = $_POST['name'];
    $course_id = $_POST['course_id'];

    $sql = "INSERT INTO subjects (name, course_id) VALUES ('$name', '$course_id')";

    if ($conn->query($sql) === TRUE) {
        $message = "Subject added successfully.";
    } else {
        $message = "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Handle subject deletion
if (isset($_GET['delete'])) {
    $subject_id = $_GET['delete'];

    $sql = "DELETE FROM subjects WHERE id='$subject_id'";

    if ($conn->query($sql) === TRUE) {
        $message = "Subject deleted successfully.";
    } else {
        $message = "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Fetch all courses for the dropdown
$courses = $conn->query("SELECT * FROM courses");

// Fetch all subjects
$subjects = $conn->query("SELECT subjects.id, subjects.name, courses.name AS course_name FROM subjects JOIN courses ON subjects.course_id = courses.id");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Subjects - University Of Sicily</title>
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
        <h4 style="color: #EABEBF">Manage Subject</h4>
    </header>

    <main>
        <section>
            <p align="center"><div>
            <section>
                <?php if (isset($message)) echo "<p>$message</p>"; ?>
                            
                <form method="post" class="room-form">
                    <h2 align="center">Add New Subject</h2>
                    <label for="name">Subject Name: </label>
                    <input type="text" name="name" id="name" required><br>
                    
                    <label for="course_id">Course: </label>
                    <select name="course_id" id="course_id" required>
                        <?php while ($course = $courses->fetch_assoc()): ?>
                            <option value="<?php echo $course['id']; ?>"><?php echo $course['name']; ?></option>
                        <?php endwhile; ?>
                    </select><br>
                    
                    <input type="hidden" name="add_subject" value="1">
                    <input type="submit" class="btn1" value="Add Subject">
                </form>
            
            
            </section>

            <section>
                <h2>Existing Subjects</h2>
                <table>
                    <tr>
                        <th>Subject Name</th>
                        <th>Course</th>
                        <th>Actions</th>
                    </tr>
                    <?php while ($subject = $subjects->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $subject['name']; ?></td>
                        <td><?php echo $subject['course_name']; ?></td>
                        <td>
                            <a href="edit_subject.php?id=<?php echo $subject['id']; ?>">Edit</a>
                            <a href="manage_subjects.php?delete=<?php echo $subject['id']; ?>" onclick="return confirm('Are you sure you want to delete this subject?');">Delete</a>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </table>
            </section>
            </p></div>
        </section>
    </main>

    <footer>
        <p>&copy; 2025 University Class Timetable. All rights reserved.</p>
    </footer>
</div>

</body>
</html>
