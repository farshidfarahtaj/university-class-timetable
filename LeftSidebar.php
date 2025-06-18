<?php
/**
 * LeftSidebar.php
 * A reusable left sidebar component for the University of Sicily web application
 */

// Function to determine if current page matches the given link
function isActive($pageName) {
    $currentPage = basename($_SERVER['PHP_SELF']);
    return $currentPage === $pageName ? 'active' : '';
}

// Determine user role and set appropriate menu items
$role = isset($_SESSION['role']) ? $_SESSION['role'] : 'guest';

// Define menu items based on user role
$menuItems = [];

switch ($role) {
    case 'admin':
        $menuItems = [
            ['link' => 'admin_dashboard.php', 'text' => 'Dashboard'],
            ['link' => 'manage_rooms.php', 'text' => 'Manage Classes'],
            ['link' => 'manage_courses.php', 'text' => 'Manage Courses'],
            ['link' => 'manage_subjects.php', 'text' => 'Manage Subjects'],
            ['link' => 'manage_timetables.php', 'text' => 'Manage Time Tables'],
            ['link' => 'manage_users.php', 'text' => 'Manage Users'],
            ['link' => 'logout.php', 'text' => 'Logout']
        ];
        break;
    case 'student':
        $menuItems = [
            ['link' => 'student_dashboard.php', 'text' => 'Dashboard'],
            ['link' => 'view_timetable.php', 'text' => 'Time Table'],
            ['link' => 'user_profile.php', 'text' => 'My Profile'],
            ['link' => 'logout.php', 'text' => 'Logout']
        ];
        break;
    default: // guest
        $menuItems = [
            ['link' => 'index.php', 'text' => 'Home'],
            ['link' => 'login.php', 'text' => 'Login'],
            ['link' => 'register.php', 'text' => 'Register'],
            ['link' => 'about_me.php', 'text' => 'About Us']
        ];
}
?>

<!-- Hamburger menu button -->
<button type="button" class="hamburger-menu" onclick="toggleSidebar()">
    <span>☰</span> Menu
</button>

<!-- Left Sidebar Component -->
<div class="left-sidebar" id="leftSidebar">
    <div class="sidebar-header">
        <button type="button" class="sidebar-close" onclick="toggleSidebar()">✕</button>
        <div class="logo-container">
            <img src="unilogo.png" alt="University Logo" class="sidebar-logo">
        </div>
        <h2>University of Sicily</h2>
    </div>
    
    <nav class="sidebar-nav">
        <ul>
            <?php foreach ($menuItems as $item): ?>
                <li>
                    <!-- Chrome compatibility: using direct hrefs without additional handlers -->
                    <a 
                        href="<?php echo htmlspecialchars($item['link']); ?>" 
                        class="nav-link <?php echo isActive($item['link']); ?>"
                        tabindex="0"
                    >
                        <span class="nav-text"><?php echo htmlspecialchars($item['text']); ?></span>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    </nav>
    
    <?php if (isset($_SESSION['username'])): ?>
    <div class="user-info">
        <p>Logged in as: <strong><?php echo htmlspecialchars($_SESSION['username']); ?></strong></p>
    </div>
    <?php endif; ?>
</div>

<!-- Add a transparent overlay when sidebar is active (for mobile) -->
<div id="sidebarOverlay" class="sidebar-overlay" onclick="toggleSidebar()"></div> 