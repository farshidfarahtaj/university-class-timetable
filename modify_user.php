<?php
include 'db.php';
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();
}

$user_id = $_GET['id'];

// Fetch available courses for majors
$majors_query = "SELECT id, name FROM courses ORDER BY name";
$majors_result = $conn->query($majors_query);

// Fetch user details
$user_result = $conn->query("SELECT * FROM users WHERE id='$user_id'");
$user = $user_result->fetch_assoc();

// Determine return page (for the back button)
$return_page = isset($_GET['return']) ? $_GET['return'] : 'manage_users.php';
if ($return_page != 'modify_students.php' && $return_page != 'manage_users.php') {
    $return_page = 'manage_users.php'; // Default to manage_users if invalid return page
}

// Handle user modification
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $role = $_POST['role'];
    $major = isset($_POST['major']) ? (int)$_POST['major'] : 'NULL';
    
    // Get profile information
    $first_name = isset($_POST['first_name']) ? trim($_POST['first_name']) : '';
    $last_name = isset($_POST['last_name']) ? trim($_POST['last_name']) : '';
    $age = isset($_POST['age']) ? (int)$_POST['age'] : 'NULL';
    
    // Validate profile info
    if (empty($first_name) || empty($last_name)) {
        $message = "First name and last name are required.";
    } elseif ($age < 16 || $age > 100) {
        $message = "Age must be between 16 and 100.";
    } else {
        // Only include major in update if user is a student
        if ($role == 'student') {
            $sql = "UPDATE users SET username='$username', first_name='$first_name', last_name='$last_name', 
                   age=$age, role='$role', major=" . ($major ? $major : "NULL") . " WHERE id='$user_id'";
        } else {
            $sql = "UPDATE users SET username='$username', first_name='$first_name', last_name='$last_name', 
                   age=$age, role='$role', major=NULL WHERE id='$user_id'";
        }

        if ($conn->query($sql) === TRUE) {
            $message = "User details updated successfully.";
        } else {
            $message = "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

// Get major name if available
$major_name = "";
if (!empty($user['major'])) {
    $major_query = "SELECT name FROM courses WHERE id = " . $user['major'];
    $major_result = $conn->query($major_query);
    if ($major_result->num_rows > 0) {
        $major_row = $major_result->fetch_assoc();
        $major_name = $major_row['name'];
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modify User - University Of Sicily</title>
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
        .form-actions {
            display: flex;
            gap: 10px;
            margin-top: 20px;
        }
        .user-detail {
            background-color: var(--bg-color);
            padding: 10px 15px;
            border-radius: 4px;
            margin-bottom: 20px;
            border-left: 3px solid var(--primary-color);
        }
        .user-detail p {
            margin: 5px 0;
        }
        .btn-back {
            background-color: #6c757d;
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
        <h4>Modify User</h4>
    </header>

    <main>
        <?php if (isset($message)): ?>
            <div class="message">
                <?php echo $message; ?>
            </div>
        <?php endif; ?>

        <section>
            <div class="section-intro">
                <h2 class="section-title">User Details</h2>
                <p class="feature-description">
                    Update user information for account <strong><?php echo htmlspecialchars($user['username']); ?></strong>.
                    You can modify the username and role of this user.
                </p>
            </div>

            <div class="card user-card">
                <div class="card-header">
                    <h3>Modify User Information</h3>
                    <p class="feature-description">Update account details and access privileges.</p>
                </div>
                
                <div class="user-detail">
                    <p><strong>User ID:</strong> <?php echo $user['id']; ?></p>
                    <p><strong>Current Role:</strong> <?php echo ucfirst($user['role']); ?></p>
                    <p><strong>Current Major:</strong> <?php echo $major_name; ?></p>
                    <p><strong>First Name:</strong> <?php echo htmlspecialchars($user['first_name'] ?? ''); ?></p>
                    <p><strong>Last Name:</strong> <?php echo htmlspecialchars($user['last_name'] ?? ''); ?></p>
                    <p><strong>Age:</strong> <?php echo $user['age'] ? htmlspecialchars($user['age']) : ''; ?></p>
                </div>
                
                <form method="post" class="admin-form">
                    <div class="form-group">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" name="username" id="username" value="<?php echo htmlspecialchars($user['username']); ?>" class="form-control" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="first_name" class="form-label">First Name</label>
                        <input type="text" name="first_name" id="first_name" value="<?php echo htmlspecialchars($user['first_name'] ?? ''); ?>" class="form-control" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="last_name" class="form-label">Last Name</label>
                        <input type="text" name="last_name" id="last_name" value="<?php echo htmlspecialchars($user['last_name'] ?? ''); ?>" class="form-control" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="age" class="form-label">Age</label>
                        <input type="number" name="age" id="age" min="16" max="100" value="<?php echo $user['age'] ?? ''; ?>" class="form-control" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="role" class="form-label">Role</label>
                        <select name="role" id="role" class="form-control" required>
                            <option value="admin" <?php if ($user['role'] == 'admin') echo 'selected'; ?>>Admin</option>
                            <option value="student" <?php if ($user['role'] == 'student') echo 'selected'; ?>>Student</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="major" class="form-label">Major</label>
                        <select name="major" id="major" class="form-control">
                            <option value="NULL">None</option>
                            <?php while ($row = $majors_result->fetch_assoc()): ?>
                                <option value="<?php echo $row['id']; ?>" <?php if ($user['major'] == $row['id']) echo 'selected'; ?>>
                                    <?php echo htmlspecialchars($row['name']); ?>
                                </option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                    
                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary">Update User</button>
                        <a href="<?php echo $return_page; ?>" class="btn btn-back">Back</a>
                    </div>
                </form>
            </div>
        </section>
    </main>

    <footer class="admin-footer">
        <p>&copy; 2025 University Of Sicily. All rights reserved.</p>
    </footer>
</div>
</body>
</html>