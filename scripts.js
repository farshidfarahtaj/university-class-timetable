document.getElementById('loginForm').addEventListener('submit', function(event) {
    event.preventDefault();
    const username = document.getElementById('username').value;
    const password = document.getElementById('password').value;

    fetch('index.php?action=login', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: `username=${encodeURIComponent(username)}&password=${encodeURIComponent(password)}`
    })
    .then(response => response.json())
    .then(data => {
        if (data.id) {
            alert('Login successful');
            // Redirect to timetable or admin page based on role
        } else {
            alert('Login failed');
        }
    });
});

document.getElementById('registerForm').addEventListener('submit', function(event) {
    event.preventDefault();
    const username = document.getElementById('username').value;
    const password = document.getElementById('password').value;
    const role = document.getElementById('role').value;

    fetch('index.php?action=register', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: `username=${encodeURIComponent(username)}&password=${encodeURIComponent(password)}&role=${encodeURIComponent(role)}`
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('Registration successful');
            // Redirect to login page
        } else {
            alert('Registration failed');
        }
    });
});

// Call init function when DOM is ready
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initAll);
} else {
    // DOM already loaded, run immediately
    initAll();
}

// Initialize all functionality
function initAll() {
    initSidebar();
    initPopups();
}

// Initialize sidebar functionality
function initSidebar() {
    // Get DOM elements
    const sidebar = document.getElementById('leftSidebar');
    const overlay = document.getElementById('sidebarOverlay');

    if (!sidebar) return;

    // Chrome compatibility fix: ensure event propagation doesn't interfere with link clicks
    sidebar.addEventListener('click', function(e) {
        // Only let the event propagate if it's not a link or link child
        if (!e.target.closest('a.nav-link')) {
            return;
        }
        
        // For link clicks on mobile, close sidebar after a delay
        if (window.innerWidth < 992) {
            setTimeout(closeSidebar, 100);
        }
    });

    // Add keyboard support for closing with Escape key
    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape' && sidebar.classList.contains('active')) {
            closeSidebar();
        }
    });
}

// Toggle sidebar open/close
function toggleSidebar() {
    const sidebar = document.getElementById('leftSidebar');
    
    if (!sidebar) return;
    
    if (sidebar.classList.contains('active')) {
        closeSidebar();
    } else {
        openSidebar();
    }
}

// Open sidebar function
function openSidebar() {
    const sidebar = document.getElementById('leftSidebar');
    const overlay = document.getElementById('sidebarOverlay');
    const mainContent = document.querySelector('.main-content');
    
    if (sidebar) sidebar.classList.add('active');
    if (overlay) overlay.classList.add('active');
    if (mainContent && window.innerWidth >= 992) {
        mainContent.classList.add('sidebar-active');
    }
    
    // Accessibility improvement
    document.body.style.overflow = 'hidden';
}

// Close sidebar function
function closeSidebar() {
    const sidebar = document.getElementById('leftSidebar');
    const overlay = document.getElementById('sidebarOverlay');
    const mainContent = document.querySelector('.main-content');
    
    if (sidebar) sidebar.classList.remove('active');
    if (overlay) overlay.classList.remove('active');
    if (mainContent) mainContent.classList.remove('sidebar-active');
    
    // Accessibility improvement
    document.body.style.overflow = '';
}

// Initialize popup messages and other UI elements
function initPopups() {
    const successMessage = document.querySelector('.success-popup');
    if (successMessage) {
        successMessage.style.display = 'block'; // Show message
        setTimeout(function() {
            successMessage.style.display = 'none'; // Hide message after 3 seconds
        }, 3000);
    }
}