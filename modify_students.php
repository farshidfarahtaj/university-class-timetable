<?php
include 'db.php';
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();
}

// Fetch all student users
$students = $conn->query("SELECT users.*, courses.name as major_name FROM users LEFT JOIN courses ON users.major = courses.id WHERE users.role='student'");

// Fetch available courses for majors
$majors_query = "SELECT id, name FROM courses ORDER BY name";
$majors_result = $conn->query($majors_query);

// Handle student registration
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['register_student'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $retype_password = $_POST['retype_password'];
    $major = isset($_POST['major']) ? (int)$_POST['major'] : 'NULL';
    
    // Get profile information
    $first_name = isset($_POST['first_name']) ? trim($_POST['first_name']) : '';
    $last_name = isset($_POST['last_name']) ? trim($_POST['last_name']) : '';
    $age = isset($_POST['age']) ? (int)$_POST['age'] : 'NULL';
    
    // Validate profile info
    if (empty($first_name) || empty($last_name)) {
        $student_message = "First name and last name are required.";
    } elseif ($age < 16 || $age > 100) {
        $student_message = "Age must be between 16 and 100.";
    }
    // Check if passwords match
    else if ($password !== $retype_password) {
        $student_message = "Passwords do not match.";
    } else {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $role = 'student';

        $sql = "INSERT INTO users (username, first_name, last_name, age, password, role, major) 
                VALUES ('$username', '$first_name', '$last_name', $age, '$hashed_password', '$role', " . ($major ? $major : "NULL") . ")";

        if ($conn->query($sql) === TRUE) {
            $student_message = "Student registration successful.";
        } else {
            $student_message = "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modify Students - University Of Sicily</title>
    <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="left-sidebar.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="admin-style.css?v=<?php echo time(); ?>">
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
        .admin-table {
            width: 100%;
            margin-top: 15px;
            border-collapse: collapse;
        }
        .admin-table th {
            background-color: var(--primary-color);
            color: white;
            padding: 12px 15px;
            text-align: left;
        }
        .admin-table td {
            padding: 10px 15px;
            border-bottom: 1px solid #eee;
        }
        .admin-table tr:hover {
            background-color: #f5f7fa;
        }
        .admin-form {
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 25px;
        }
        .action-links a {
            padding: 5px 10px;
            margin-right: 5px;
            border-radius: 4px;
            text-decoration: none;
            color: white;
            font-size: 0.9rem;
        }
        .action-links a.edit {
            background-color: var(--secondary-color);
        }
        .action-links a.delete {
            background-color: var(--accent-color);
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
        <h4>Manage Students</h4>
    </header>

    <main>
        <?php if (isset($student_message)): ?>
            <div class="message">
                <?php echo $student_message; ?>
            </div>
        <?php endif; ?>
        
        <?php 
        if (isset($_SESSION['message'])) {
            echo '<div class="message">' . $_SESSION['message'] . '</div>';
            unset($_SESSION['message']);
        }
        ?>

        <section>
            <div class="section-intro">
                <h2 class="section-title">Student Management</h2>
                <p class="feature-description">
                    Create and manage student accounts for the University of Sicily system.
                    Students can access their course schedules and view class timetables.
                </p>
            </div>

            <div class="card user-card">
                <div class="card-header">
                    <h3>Register New Student</h3>
                    <p class="feature-description">Create a new student account with system access.</p>
                </div>
                <form method="post" class="admin-form">
                    <div class="form-group">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" name="username" id="username" class="form-control" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="first_name" class="form-label">First Name</label>
                        <input type="text" name="first_name" id="first_name" class="form-control" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="last_name" class="form-label">Last Name</label>
                        <input type="text" name="last_name" id="last_name" class="form-control" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="age" class="form-label">Age</label>
                        <input type="number" name="age" id="age" min="16" max="100" class="form-control" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" name="password" id="password" class="form-control" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="retype_password" class="form-label">Re-type Password</label>
                        <input type="password" name="retype_password" id="retype_password" class="form-control" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="major" class="form-label">Major</label>
                        <select name="major" id="major" class="form-control">
                            <option value="">Select a major</option>
                            <?php while ($row = $majors_result->fetch_assoc()): ?>
                                <option value="<?php echo $row['id']; ?>"><?php echo htmlspecialchars($row['name']); ?></option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                    
                    <input type="hidden" name="register_student" value="1">
                    <button type="submit" class="btn btn-primary">Register Student</button>
                </form>
            </div>

            <div class="card user-card">
                <div class="card-header">
                    <h3>Current Students</h3>
                    <p class="feature-description">View, edit or remove existing student accounts.</p>
                </div>
                
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>Username</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Age</th>
                            <th>Role</th>
                            <th>Major</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if($students->num_rows > 0): ?>
                            <?php while ($student = $students->fetch_assoc()): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($student['username']); ?></td>
                                <td><?php echo htmlspecialchars($student['first_name'] ?? '-'); ?></td>
                                <td><?php echo htmlspecialchars($student['last_name'] ?? '-'); ?></td>
                                <td><?php echo $student['age'] ? htmlspecialchars($student['age']) : '-'; ?></td>
                                <td><?php echo ucfirst(htmlspecialchars($student['role'])); ?></td>
                                <td><?php echo htmlspecialchars($student['major_name']); ?></td>
                                <td class="action-links">
                                    <a href="modify_user.php?id=<?php echo $student['id']; ?>&return=modify_students.php" class="edit">Edit</a>
                                    <a href="delete_user.php?id=<?php echo $student['id']; ?>" 
                                       onclick="return confirm('Are you sure you want to delete this student?');" 
                                       class="delete">Delete</a>
                                    <a href="reset_password.php?id=<?php echo $student['id']; ?>&redirect=modify_students.php" 
                                       class="reset" style="background-color: #f39c12;">Reset Password</a>
                                </td>
                            </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="7">No students found.</td>
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