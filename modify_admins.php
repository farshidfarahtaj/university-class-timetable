<?php
include 'db.php';
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();
}

// Handle admin registration
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['register_admin'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $retype_password = $_POST['retype_password'];
    
    // Check if passwords match
    if ($password !== $retype_password) {
        $admin_message = "Passwords do not match.";
    } else {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $role = 'admin';

        $sql = "INSERT INTO users (username, password, role) VALUES ('$username', '$hashed_password', '$role')";

        if ($conn->query($sql) === TRUE) {
            $admin_message = "Admin registration successful.";
        } else {
            $admin_message = "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

// Fetch all admin users
$admins = $conn->query("SELECT * FROM users WHERE role='admin'");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modify Admins - University Of Sicily</title>
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
        <h4>Manage Admins</h4>
    </header>

    <main>
        <?php if (isset($admin_message)): ?>
            <div class="message">
                <?php echo $admin_message; ?>
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
                <h2 class="section-title">Administrator Management</h2>
                <p class="feature-description">
                    Create and manage administrator accounts for the University of Sicily system.
                    Administrators have full access to the system and can manage courses, timetables, and users.
                </p>
            </div>

            <div class="card user-card">
                <div class="card-header">
                    <h3>Register New Administrator</h3>
                    <p class="feature-description">Create a new administrator account with system access privileges.</p>
                </div>
                <form method="post" class="admin-form">
                    <div class="form-group">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" name="username" id="username" class="form-control" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" name="password" id="password" class="form-control" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="retype_password" class="form-label">Re-type Password</label>
                        <input type="password" name="retype_password" id="retype_password" class="form-control" required>
                    </div>
                    
                    <input type="hidden" name="register_admin" value="1">
                    <button type="submit" class="btn btn-primary">Register Administrator</button>
                </form>
            </div>

            <div class="card user-card">
                <div class="card-header">
                    <h3>Current Administrators</h3>
                    <p class="feature-description">View, edit or remove existing administrator accounts.</p>
                </div>
                
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>Username</th>
                            <th>Role</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if($admins->num_rows > 0): ?>
                            <?php while ($admin = $admins->fetch_assoc()): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($admin['username']); ?></td>
                                <td><?php echo ucfirst(htmlspecialchars($admin['role'])); ?></td>
                                <td class="action-links">
                                    <a href="modify_user.php?id=<?php echo $admin['id']; ?>" class="edit">Edit</a>
                                    <?php if($admin['username'] !== $_SESSION['username']): ?>
                                        <a href="delete_user.php?id=<?php echo $admin['id']; ?>" 
                                           onclick="return confirm('Are you sure you want to delete this admin?');" 
                                           class="delete">Delete</a>
                                    <?php endif; ?>
                                    <a href="reset_password.php?id=<?php echo $admin['id']; ?>&redirect=modify_admins.php" 
                                       class="reset" style="background-color: #f39c12;">Reset Password</a>
                                </td>
                            </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="3">No administrators found.</td>
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