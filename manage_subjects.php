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
        <h4>Manage Subjects</h4>
    </header>

    <main>
        <?php if (isset($message)): ?>
            <div class="message success">
                <i>✓</i> <?php echo $message; ?>
            </div>
        <?php endif; ?>

        <section>
            <div class="section-intro">
                <h2 class="section-title">Subject Management</h2>
                <p class="feature-description">
                    Create and manage subjects for the University of Sicily system.
                    Subjects are organized under courses and used in timetables.
                </p>
            </div>
            
            <div class="card subject-card">
                <div class="card-header">
                    <h3>Add New Subject</h3>
                    <p class="feature-description">Create a new subject and assign it to a course.</p>
                </div>
                <form method="post" class="admin-form">
                    <div class="form-group">
                        <label for="name" class="form-label">Subject Name</label>
                        <input type="text" name="name" id="name" class="form-control" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="course_id" class="form-label">Course</label>
                        <select name="course_id" id="course_id" class="form-control" required>
                            <?php while ($course = $courses->fetch_assoc()): ?>
                                <option value="<?php echo $course['id']; ?>"><?php echo $course['name']; ?></option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                    
                    <input type="hidden" name="add_subject" value="1">
                    <button type="submit" class="btn btn-primary">Add Subject</button>
                </form>
            </div>

            <div class="card subject-card">
                <div class="card-header">
                    <h3>Existing Subjects</h3>
                    <p class="feature-description">View, edit or remove subject entries.</p>
                </div>
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>Subject Name</th>
                            <th>Course</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($subject = $subjects->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($subject['name']); ?></td>
                            <td><?php echo htmlspecialchars($subject['course_name']); ?></td>
                            <td class="action-links">
                                <a href="edit_subject.php?id=<?php echo $subject['id']; ?>" class="edit" title="Edit Subject">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <a href="manage_subjects.php?delete=<?php echo $subject['id']; ?>" 
                                   onclick="return confirm('Are you sure you want to delete this subject?');" 
                                   class="delete" title="Delete Subject">
                                    <i class="fa fa-trash"></i>
                                </a>
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
