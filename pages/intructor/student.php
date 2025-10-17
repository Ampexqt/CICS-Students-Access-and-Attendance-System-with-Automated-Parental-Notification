<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Students Management - CICS Attendance System</title>
    <link rel="stylesheet" href="student.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/lucide/1.0.0/lucide.min.css" rel="stylesheet">
</head>
<body>
    <!-- Sidebar -->
    <aside class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <img src="../../assets/logo/cics_logo.png" alt="CICS Logo" class="sidebar-logo">
            <h1>CICS Attendance</h1>
        </div>
        
        <nav class="sidebar-nav">
            <div class="nav-item">
                <a href="intructor.php" class="nav-link">
                    <i data-lucide="layout-dashboard" class="nav-icon"></i>
                    <span>Dashboard</span>
                </a>
            </div>
            <div class="nav-item">
                <a href="Classes.php" class="nav-link">
                    <i data-lucide="book-open" class="nav-icon"></i>
                    <span>Classes</span>
                </a>
            </div>
            <div class="nav-item">
                <a href="#" class="nav-link active">
                    <i data-lucide="users" class="nav-icon"></i>
                    <span>Students</span>
                </a>
            </div>
            <div class="nav-item">
                <a href="report.php" class="nav-link">
                    <i data-lucide="bar-chart-3" class="nav-icon"></i>
                    <span>Reports</span>
                </a>
            </div>
            
            <div class="sidebar-separator"></div>
            
            <div class="nav-item">
                <a href="#" class="nav-link">
                    <i data-lucide="map-pin" class="nav-icon"></i>
                    <span>GPS Settings</span>
                </a>
            </div>
            <div class="nav-item">
                <a href="#" class="nav-link">
                    <i data-lucide="settings" class="nav-icon"></i>
                    <span>Account Settings</span>
                </a>
            </div>
            
            <div class="sidebar-separator"></div>
            
            <div class="nav-item">
                <a href="#" class="nav-link">
                    <i data-lucide="log-out" class="nav-icon"></i>
                    <span>Logout</span>
                </a>
            </div>
        </nav>
    </aside>

    <!-- Sidebar Overlay -->
    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <!-- Header -->
    <header class="header">
        <div class="container">
            <div class="header-content">
                <div class="logo">
                    <button class="mobile-menu-btn" id="mobileMenuBtn">
                        <i data-lucide="menu"></i>
                    </button>
                    <div class="logo-icon">
                        <i data-lucide="graduation-cap"></i>
                    </div>
                    <div class="logo-text">
                        <span class="logo-primary">CICS</span>
                        <span class="logo-secondary">Attendance</span>
                    </div>
                </div>
                
                <div class="user-menu">
                    <button class="icon-btn">
                        <i data-lucide="bell"></i>
                        <span class="notification-badge">2</span>
                    </button>
                    <button class="icon-btn">
                        <i data-lucide="calendar"></i>
                    </button>
                    <div class="user-profile">
                        <div class="user-avatar">
                            <i data-lucide="user"></i>
                        </div>
                        <div class="user-info">
                            <span class="user-name">Prof. Smith</span>
                            <span class="user-role">Instructor</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="main-content">
        <!-- Hero Section -->
        <section class="hero-section animate-fadeInUp">
            <div class="container">
                <div class="hero-content">
                    <div class="hero-text">
                        <h1 class="hero-title">Student Management</h1>
                        <p class="hero-subtitle">Monitor attendance, track performance, and manage student records efficiently</p>
                        <div class="card-actions">
                            <button class="btn btn-primary btn-lg" id="addStudentBtn">
                                <i data-lucide="user-plus"></i>
                                Add New Student
                            </button>
                            <button class="btn btn-secondary btn-lg">
                                <i data-lucide="download"></i>
                                Export Data
                            </button>
                        </div>
                    </div>
                    <div class="hero-image">
                        <div class="hero-icon">
                            <i data-lucide="users"></i>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <div class="container">
            <!-- Statistics Cards -->
            <div class="stats-grid animate-fadeInUp">
                <div class="stat-card">
                    <div class="stat-value">124</div>
                    <div class="stat-label">Total Students</div>
                    <div class="stat-change positive">
                        <i data-lucide="trending-up"></i>
                        +8 this month
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-value">92%</div>
                    <div class="stat-label">Average Attendance</div>
                    <div class="stat-change positive">
                        <i data-lucide="trending-up"></i>
                        +2.5%
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-value">18</div>
                    <div class="stat-label">Active Classes</div>
                    <div class="stat-change positive">
                        <i data-lucide="book-open"></i>
                        5 sections
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-value">3</div>
                    <div class="stat-label">Pending Requests</div>
                    <div class="stat-change negative">
                        <i data-lucide="alert-circle"></i>
                        Needs attention
                    </div>
                </div>
            </div>

            <!-- Search and Filters -->
            <div class="search-filters animate-fadeInUp">
                <div class="search-row">
                    <div class="search-input">
                        <label class="form-label">Search Students</label>
                        <input type="text" class="form-input" placeholder="Search by name, ID, or email...">
                        <i data-lucide="search" class="search-icon"></i>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Class</label>
                        <select class="form-select">
                            <option>All Classes</option>
                            <option>CS 101 - Introduction to Programming</option>
                            <option>CS 202 - Data Structures</option>
                            <option>CS 305 - Algorithm Design</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Section</label>
                        <select class="form-select">
                            <option>All Sections</option>
                            <option>Section A</option>
                            <option>Section B</option>
                            <option>Section C</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Status</label>
                        <select class="form-select">
                            <option>All Status</option>
                            <option>Active</option>
                            <option>Inactive</option>
                            <option>Graduated</option>
                        </select>
                    </div>
                    <button class="btn btn-gold">
                        <i data-lucide="filter"></i>
                        Apply Filters
                    </button>
                </div>
            </div>

            <!-- Students Table -->
            <div class="card animate-fadeInUp">
                <div class="card-header">
                    <div class="card-title">
                        <i data-lucide="users" class="card-icon"></i>
                        <h2>Student Records</h2>
                    </div>
                    <div class="card-actions">
                        <button class="btn btn-sm btn-secondary">
                            <i data-lucide="printer"></i>
                            Print
                        </button>
                        <button class="btn btn-sm btn-primary">
                            <i data-lucide="download"></i>
                            Export Excel
                        </button>
                    </div>
                </div>
                
                <div class="table-container">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>Student</th>
                                <th>Student ID</th>
                                <th>Class</th>
                                <th>Section</th>
                                <th>Attendance Rate</th>
                                <th>Last Attendance</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <div class="student-info">
                                        <div class="student-avatar">
                                            <i data-lucide="user"></i>
                                        </div>
                                        <div>
                                            <div class="student-name">John Smith</div>
                                            <div class="student-id">john.smith@cics.edu</div>
                                        </div>
                                    </div>
                                </td>
                                <td>2023001</td>
                                <td>CS 101</td>
                                <td>Section A</td>
                                <td>95%</td>
                                <td>Oct 15, 2023</td>
                                <td><span class="status-badge status-present">Present</span></td>
                                <td>
                                    <div class="card-actions">
                                        <button class="btn btn-sm btn-secondary">
                                            <i data-lucide="eye"></i>
                                        </button>
                                        <button class="btn btn-sm btn-primary">
                                            <i data-lucide="edit"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="student-info">
                                        <div class="student-avatar">
                                            <i data-lucide="user"></i>
                                        </div>
                                        <div>
                                            <div class="student-name">Emily Johnson</div>
                                            <div class="student-id">emily.johnson@cics.edu</div>
                                        </div>
                                    </div>
                                </td>
                                <td>2023002</td>
                                <td>CS 202</td>
                                <td>Section B</td>
                                <td>88%</td>
                                <td>Oct 14, 2023</td>
                                <td><span class="status-badge status-late">Late</span></td>
                                <td>
                                    <div class="card-actions">
                                        <button class="btn btn-sm btn-secondary">
                                            <i data-lucide="eye"></i>
                                        </button>
                                        <button class="btn btn-sm btn-primary">
                                            <i data-lucide="edit"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="student-info">
                                        <div class="student-avatar">
                                            <i data-lucide="user"></i>
                                        </div>
                                        <div>
                                            <div class="student-name">Michael Brown</div>
                                            <div class="student-id">michael.brown@cics.edu</div>
                                        </div>
                                    </div>
                                </td>
                                <td>2023003</td>
                                <td>CS 101</td>
                                <td>Section A</td>
                                <td>92%</td>
                                <td>Oct 15, 2023</td>
                                <td><span class="status-badge status-present">Present</span></td>
                                <td>
                                    <div class="card-actions">
                                        <button class="btn btn-sm btn-secondary">
                                            <i data-lucide="eye"></i>
                                        </button>
                                        <button class="btn btn-sm btn-primary">
                                            <i data-lucide="edit"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="student-info">
                                        <div class="student-avatar">
                                            <i data-lucide="user"></i>
                                        </div>
                                        <div>
                                            <div class="student-name">Jessica Davis</div>
                                            <div class="student-id">jessica.davis@cics.edu</div>
                                        </div>
                                    </div>
                                </td>
                                <td>2023004</td>
                                <td>CS 305</td>
                                <td>Section C</td>
                                <td>76%</td>
                                <td>Oct 12, 2023</td>
                                <td><span class="status-badge status-absent">Absent</span></td>
                                <td>
                                    <div class="card-actions">
                                        <button class="btn btn-sm btn-secondary">
                                            <i data-lucide="eye"></i>
                                        </button>
                                        <button class="btn btn-sm btn-primary">
                                            <i data-lucide="edit"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="student-info">
                                        <div class="student-avatar">
                                            <i data-lucide="user"></i>
                                        </div>
                                        <div>
                                            <div class="student-name">David Wilson</div>
                                            <div class="student-id">david.wilson@cics.edu</div>
                                        </div>
                                    </div>
                                </td>
                                <td>2023005</td>
                                <td>CS 202</td>
                                <td>Section B</td>
                                <td>94%</td>
                                <td>Oct 15, 2023</td>
                                <td><span class="status-badge status-excused">Excused</span></td>
                                <td>
                                    <div class="card-actions">
                                        <button class="btn btn-sm btn-secondary">
                                            <i data-lucide="eye"></i>
                                        </button>
                                        <button class="btn btn-sm btn-primary">
                                            <i data-lucide="edit"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                
                <div class="pagination">
                    <div class="pagination-info">
                        Showing 5 of 124 students
                    </div>
                    <div class="pagination-controls">
                        <button class="btn btn-sm btn-secondary">Previous</button>
                        <button class="btn btn-sm btn-primary">Next</button>
                    </div>
                </div>
            </div>

            <!-- Feature Cards -->
            <div class="feature-grid animate-fadeInUp">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i data-lucide="clock"></i>
                    </div>
                    <h3 class="feature-title">Attendance Tracking</h3>
                    <p class="feature-description">Monitor real-time attendance with automated notifications for absences and tardiness.</p>
                </div>
                
                <div class="feature-card">
                    <div class="feature-icon">
                        <i data-lucide="bar-chart-3"></i>
                    </div>
                    <h3 class="feature-title">Performance Analytics</h3>
                    <p class="feature-description">View detailed attendance statistics and performance trends for each student.</p>
                </div>
                
                <div class="feature-card">
                    <div class="feature-icon">
                        <i data-lucide="clipboard-check"></i>
                    </div>
                    <h3 class="feature-title">Correction Requests</h3>
                    <p class="feature-description">Handle student correction requests for missed check-ins and attendance disputes.</p>
                </div>
            </div>
        </div>
    </main>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/lucide/1.0.0/lucide.min.js"></script>
    <script>
        // Initialize Lucide icons
        lucide.createIcons();

        // Sidebar functionality
        const sidebar = document.getElementById('sidebar');
        const sidebarOverlay = document.getElementById('sidebarOverlay');
        const mobileMenuBtn = document.getElementById('mobileMenuBtn');

        mobileMenuBtn.addEventListener('click', () => {
            sidebar.classList.toggle('open');
            sidebarOverlay.classList.toggle('active');
        });

        sidebarOverlay.addEventListener('click', () => {
            sidebar.classList.remove('open');
            sidebarOverlay.classList.remove('active');
        });

        // Handle window resize
        window.addEventListener('resize', () => {
            if (window.innerWidth >= 768) {
                sidebar.classList.remove('open');
                sidebarOverlay.classList.remove('active');
            }
        });

        // Navigation active states
        document.querySelectorAll('.sidebar-nav .nav-link').forEach(link => {
            link.addEventListener('click', (e) => {
                document.querySelectorAll('.sidebar-nav .nav-link').forEach(l => l.classList.remove('active'));
                e.currentTarget.classList.add('active');
            });
        });

        // Add student functionality
        document.getElementById('addStudentBtn').addEventListener('click', () => {
            alert('Add Student functionality would open a modal or redirect to add student page');
        });

        // Initialize page
        document.addEventListener('DOMContentLoaded', () => {
            lucide.createIcons();
        });
    </script>
</body>
</html>