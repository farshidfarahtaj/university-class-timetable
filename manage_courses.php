<?php
include 'db.php';
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();
}

// Handle course addition
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_course'])) {
    $name = $_POST['name'];
    $code = $_POST['code'];

    $sql = "INSERT INTO courses (name, code) VALUES ('$name', '$code')";

    if ($conn->query($sql) === TRUE) {
        $message = "Course added successfully.";
        $message_type = "success";
    } else {
        $message = "Error: " . $sql . "<br>" . $conn->error;
        $message_type = "error";
    }
}

// Handle course deletion
if (isset($_GET['delete'])) {
    $course_id = $_GET['delete'];

    $sql = "DELETE FROM courses WHERE id='$course_id'";

    if ($conn->query($sql) === TRUE) {
        $message = "Course deleted successfully.";
        $message_type = "success";
    } else {
        $message = "Error: " . $sql . "<br>" . $conn->error;
        $message_type = "error";
    }
}

// Fetch all courses
$courses = $conn->query("SELECT * FROM courses");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Courses - University Of Sicily</title>
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
        <h4>Manage Courses</h4>
    </header>

    <main>
        <?php if(isset($message)): ?>
            <div class="message <?php echo $message_type; ?>">
                <i><?php echo $message_type == 'success' ? '✓' : '⚠'; ?></i> <?php echo $message; ?>
            </div>
        <?php endif; ?>
        
        <section>
            <div class="section-intro">
                <h2 class="section-title">Course Management</h2>
                <p class="feature-description">
                    Create and manage courses for the University of Sicily system.
                    Courses are used to organize subjects and create program structures.
                </p>
            </div>
            
            <div class="card course-card">
                <div class="card-header">
                    <h3>Add New Course</h3>
                    <p class="feature-description">Create a new course with a name and code.</p>
                </div>
                <form method="post" class="admin-form">
                    <div class="form-group">
                        <label for="name" class="form-label">Course Name</label>
                        <input type="text" id="name" name="name" class="form-control" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="code" class="form-label">Course Code</label>
                        <input type="text" id="code" name="code" class="form-control" required>
                    </div>
                    
                    <input type="hidden" name="add_course" value="1">
                    <button type="submit" class="btn btn-primary">Add Course</button>
                </form>
            </div>

            <div class="card course-card">
                <div class="card-header">
                    <h3>Existing Courses</h3>
                    <p class="feature-description">View, edit or remove course entries.</p>
                </div>
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>Course Name</th>
                            <th>Course Code</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if($courses->num_rows > 0): ?>
                            <?php while ($course = $courses->fetch_assoc()): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($course['name']); ?></td>
                                <td><?php echo htmlspecialchars($course['code']); ?></td>
                                <td class="action-links">
                                    <a href="edit_course.php?id=<?php echo $course['id']; ?>" class="edit" title="Edit Course">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <a href="manage_courses.php?delete=<?php echo $course['id']; ?>" 
                                       onclick="return confirm('Are you sure you want to delete this course?');" 
                                       class="delete" title="Delete Course">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="3">No courses found.</td>
                            </tr>
                        <?php endif; ?>
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