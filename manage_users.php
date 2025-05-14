<?php
include 'db.php';
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();
}

// Handle admin registration
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['register_admin'])) {
    $username = $_POST['admin_username'];
    $password = password_hash($_POST['admin_password'], PASSWORD_DEFAULT);
    $role = 'admin';

    $sql = "INSERT INTO users (username, password, role) VALUES ('$username', '$password', '$role')";

    if ($conn->query($sql) === TRUE) {
        $admin_message = "Admin registration successful.";
    } else {
        $admin_message = "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Handle admin removal
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['remove_admin'])) {
    $admin_id = $_POST['admin_id'];

    $sql = "DELETE FROM users WHERE id='$admin_id' AND role='admin'";

    if ($conn->query($sql) === TRUE) {
        $remove_message = "Admin removal successful.";
    } else {
        $remove_message = "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Fetch all admins
$admins = $conn->query("SELECT * FROM users WHERE role='admin'");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Users - University Of Sicily</title>
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
        .admin-list {
            margin-top: 20px;
        }
        .admin-form {
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 25px;
        }
        .admin-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
            margin-top: 20px;
        }
        .admin-item {
            background: white;
            border-radius: 8px;
            padding: 15px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
            position: relative;
        }
        .admin-item h4 {
            margin-bottom: 10px;
            color: var(--primary-color);
            border-bottom: 1px solid #eee;
            padding-bottom: 8px;
        }
        .admin-detail {
            margin: 5px 0;
            font-size: 0.9rem;
        }
        .admin-actions {
            margin-top: 15px;
            display: flex;
            justify-content: flex-end;
        }
        .section-intro {
            margin-bottom: 25px;
            padding-left: 15px;
            border-left: 4px solid var(--secondary-color);
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
        <h4>Manage Users</h4>
    </header>

    <main>
        <?php if(isset($admin_message)): ?>
            <div class="message success">
                <i>✓</i> <?php echo $admin_message; ?>
            </div>
        <?php endif; ?>

        <?php if(isset($remove_message)): ?>
            <div class="message info">
                <i>ℹ</i> <?php echo $remove_message; ?>
            </div>
        <?php endif; ?>

        <section>
            <div class="section-intro">
                <h2 class="section-title">User Management Dashboard</h2>
                <p class="feature-description">
                    Manage administrator and student accounts for the University of Sicily system.
                    From this central hub, you can add new administrators, remove existing ones, 
                    and access student management tools.
                </p>
            </div>

            <div class="card user-card">
                <div class="card-header">
                    <h3>User Access Management</h3>
                    <p class="feature-description">Control access to the system by managing different user types.</p>
                </div>
                <div class="btn-group">
                    <a href="modify_students.php" class="btn btn-primary">Manage Students</a>
                    <a href="modify_admins.php" class="btn btn-primary">Manage Admins</a>
                </div>
            </div>

            <div class="card user-card">
                <div class="card-header">
                    <h3>Add New Administrator</h3>
                    <p class="feature-description">Create new administrator accounts with full system access.</p>
                </div>
                <form method="POST" action="" class="admin-form">
                    <div class="form-group">
                        <label for="admin_username" class="form-label">Username</label>
                        <input type="text" name="admin_username" id="admin_username" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="admin_password" class="form-label">Password</label>
                        <input type="password" name="admin_password" id="admin_password" class="form-control" required>
                    </div>
                    <button type="submit" name="register_admin" class="btn btn-primary">Register Administrator</button>
                </form>
            </div>

            <div class="card user-card">
                <div class="card-header">
                    <h3>Current Administrators</h3>
                    <p class="feature-description">View and manage existing administrator accounts.</p>
                </div>
                
                <div class="admin-list">
                    <?php if($admins->num_rows > 0): ?>
                        <div class="admin-grid">
                            <?php while($admin = $admins->fetch_assoc()): ?>
                                <div class="admin-item">
                                    <h4><?php echo htmlspecialchars($admin['username']); ?></h4>
                                    <p class="admin-detail"><strong>ID:</strong> <?php echo $admin['id']; ?></p>
                                    <p class="admin-detail"><strong>Role:</strong> <?php echo ucfirst($admin['role']); ?></p>
                                    
                                    <?php if($admin['username'] !== $_SESSION['username']): ?>
                                        <div class="admin-actions">
                                            <form method="POST" action="" onsubmit="return confirm('Are you sure you want to remove this administrator?');">
                                                <input type="hidden" name="admin_id" value="<?php echo $admin['id']; ?>">
                                                <button type="submit" name="remove_admin" class="btn btn-danger">Remove</button>
                                            </form>
                                        </div>
                                    <?php else: ?>
                                        <p class="admin-detail"><em>(Current user)</em></p>
                                    <?php endif; ?>
                                </div>
                            <?php endwhile; ?>
                        </div>
                    <?php else: ?>
                        <p>No administrators found.</p>
                    <?php endif; ?>
                </div>
            </div>
        </section>
    </main>

    <footer class="admin-footer">
        <p>&copy; 2025 University Of Sicily. All rights reserved.</p>
    </footer>
</div>
</body>
</html>