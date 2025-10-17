<?php
// Shared Sidebar Component for CICS Instructor Pages
// Usage: include 'sidebar-include.php';

// Get current page to set active navigation
$current_page = basename($_SERVER['PHP_SELF']);
?>

<!-- Sidebar -->
<aside class="sidebar" id="sidebar" role="navigation" aria-label="Main navigation" aria-hidden="true">
    <div class="sidebar-header">
        <img src="../../assets/logo/cics_logo.png" alt="CICS Logo" class="sidebar-logo">
        <h1>CICS Attendance</h1>
    </div>
    
    <nav class="sidebar-nav" role="menu">
        <div class="nav-item">
            <a href="intructor.php" class="nav-link <?php echo ($current_page == 'intructor.php') ? 'active' : ''; ?>" role="menuitem" aria-label="<?php echo ($current_page == 'intructor.php') ? 'Dashboard (current)' : 'Go to Dashboard'; ?>" <?php echo ($current_page == 'intructor.php') ? 'aria-current="page"' : ''; ?>>
                <i data-lucide="layout-dashboard" class="nav-icon" aria-hidden="true"></i>
                <span>Dashboard</span>
            </a>
        </div>
        <div class="nav-item">
            <a href="Classes.php" class="nav-link <?php echo ($current_page == 'Classes.php') ? 'active' : ''; ?>" role="menuitem" aria-label="<?php echo ($current_page == 'Classes.php') ? 'Classes (current)' : 'Go to Classes'; ?>" <?php echo ($current_page == 'Classes.php') ? 'aria-current="page"' : ''; ?>>
                <i data-lucide="book-open" class="nav-icon" aria-hidden="true"></i>
                <span>Classes</span>
            </a>
        </div>
        <div class="nav-item">
            <a href="student.php" class="nav-link <?php echo ($current_page == 'student.php') ? 'active' : ''; ?>" role="menuitem" aria-label="<?php echo ($current_page == 'student.php') ? 'Students (current)' : 'Go to Students'; ?>" <?php echo ($current_page == 'student.php') ? 'aria-current="page"' : ''; ?>>
                <i data-lucide="users" class="nav-icon" aria-hidden="true"></i>
                <span>Students</span>
            </a>
        </div>
        <div class="nav-item">
            <a href="report.php" class="nav-link <?php echo ($current_page == 'report.php') ? 'active' : ''; ?>" role="menuitem" aria-label="<?php echo ($current_page == 'report.php') ? 'Reports (current)' : 'Go to Reports'; ?>" <?php echo ($current_page == 'report.php') ? 'aria-current="page"' : ''; ?>>
                <i data-lucide="bar-chart-3" class="nav-icon" aria-hidden="true"></i>
                <span>Reports</span>
            </a>
        </div>
        
        <div class="sidebar-separator" role="separator"></div>
        
        <div class="nav-item">
            <a href="#" class="nav-link" role="menuitem" aria-label="Logout" onclick="handleLogout(event)">
                <i data-lucide="log-out" class="nav-icon" aria-hidden="true"></i>
                <span>Logout</span>
            </a>
        </div>
    </nav>
</aside>

<!-- Sidebar Overlay -->
<div class="sidebar-overlay" id="sidebarOverlay"></div>

<script>
// Logout handler
function handleLogout(event) {
    event.preventDefault();
    if (confirm('Are you sure you want to logout?')) {
        // In a real application, this would redirect to logout handler
        console.log('Logging out...');
        // window.location.href = 'logout.php';
    }
}
</script>
