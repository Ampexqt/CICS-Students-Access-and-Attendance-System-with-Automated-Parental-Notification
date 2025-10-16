<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CICS Attendance System</title>
    <link rel="stylesheet" href="student.dashboard.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&family=Montserrat:wght@400;500;600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body>
    <div class="app-container">
        <!-- Header -->
        <header class="header">
            <div class="header-container">
                <div class="header-left">
                    <button class="mobile-menu-toggle" id="mobileMenuToggle" aria-label="Toggle menu">
                        <span class="material-icons">menu</span>
                    </button>
                </div>
                <div class="header-right">
                    <button class="notification-btn" aria-label="Notifications">
                        <span class="material-icons">notifications</span>
                        <span class="notification-dot"></span>
                    </button>
                    <div class="user-menu">
                        <div class="user-info">
                            <div class="user-avatar">DM</div>
                            <div class="user-details">
                                <span class="user-name">Dean Martinez</span>
                                <span class="user-role">Student</span>
                            </div>
                            <button class="user-dropdown-btn" aria-label="User menu">
                                <span class="material-icons">keyboard_arrow_down</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <!-- Page Header -->
        

        <!-- Main Layout -->
        <div class="layout">
            <!-- Sidebar (Desktop) -->
            <aside class="sidebar">
                <div class="sidebar-header">
                    <img src="https://uploadthingy.s3.us-west-1.amazonaws.com/gaDEujMGhH3qGpTeHVVFhi/ZPPUS-CICS_LOGO.jpg" alt="CICS Logo" class="sidebar-logo">
                    <h1>CICS</h1>
                </div>
                <nav class="sidebar-nav">
                    <a href="#dashboard" class="nav-item active">
                        <span class="material-icons">home</span>
                        <span class="nav-text">Dashboard</span>
                    </a>
                    <a href="#attendance-logs" class="nav-item">
                        <span class="material-icons">checklist</span>
                        <span class="nav-text">Attendance Logs</span>
                    </a>
                    <a href="#statistics" class="nav-item">
                        <span class="material-icons">bar_chart</span>
                        <span class="nav-text">Statistics</span>
                    </a>
                    <a href="#schedule" class="nav-item">
                        <span class="material-icons">calendar_today</span>
                        <span class="nav-text">Schedule</span>
                    </a>
                    <a href="#requests" class="nav-item">
                        <span class="material-icons">description</span>
                        <span class="nav-text">Requests</span>
                    </a>
                    <a href="#profile" class="nav-item">
                        <span class="material-icons">person</span>
                        <span class="nav-text">Profile</span>
                    </a>
                    <a href="#settings" class="nav-item">
                        <span class="material-icons">settings</span>
                        <span class="nav-text">Settings</span>
                    </a>
                    <a href="#logout" class="nav-item logout-item">
                        <span class="material-icons">logout</span>
                        <span class="nav-text">Logout</span>
                    </a>
                </nav>
            </aside>

            <!-- Main Content -->
            <main class="main-content">
                <!-- Dashboard Section (hidden by default) -->
                <section id="dashboard" class="section">
                    <div class="dashboard-header">
                        <h1 class="dashboard-title">Welcome back, John!</h1>
                        <p class="dashboard-subtitle">Track your attendance and class schedule</p>
                    </div>
                    
                    <div class="dashboard-actions">
                        <button class="attendance-btn">
                            <span class="material-icons">fingerprint</span>
                            Tap to Attend / Time In
                        </button>
                    </div>
                    
                    <div class="dashboard-cards">
                        <!-- Attendance Card -->
                        <div class="card attendance-card">
                            <div class="card-header">
                                <h2 class="card-title">Attendance Rate</h2>
                                <span class="material-icons card-icon">check_circle</span>
                            </div>
                            <div class="card-content">
                                <div class="progress-info">
                                    <span>Progress</span>
                                    <span>95%</span>
                                </div>
                                <div class="progress-bar">
                                    <div class="progress-fill" style="width: 95%"></div>
                                </div>
                                <div class="attendance-stats">
                                    <p>
                                        <span class="highlight">19/20</span> classes this semester
                                    </p>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Next Class Card -->
                        <div class="card next-class-card">
                            <div class="card-header">
                                <h2 class="card-title">Next Class</h2>
                                <span class="material-icons card-icon">calendar_today</span>
                            </div>
                            <div class="card-content">
                                <h3 class="class-name">Database Systems</h3>
                                <div class="class-details">
                                    <div class="detail-item">
                                        <span class="material-icons">location_on</span>
                                        <span>Room: CICS 301</span>
                                    </div>
                                    <div class="detail-item">
                                        <span class="material-icons">schedule</span>
                                        <span>10:00 AM to 11:30 AM</span>
                                    </div>
                                </div>
                                <div class="class-instructor">
                                    <p>Prof. Maria Santos</p>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Device Status Card -->
                        <div class="card device-status-card">
                            <div class="card-header">
                                <h2 class="card-title">Device Status</h2>
                                <span class="material-icons card-icon">check_circle</span>
                            </div>
                            <div class="card-content">
                                <div class="status-message">
                                    <span class="material-icons status-icon">check_circle</span>
                                    <p>Time out recorded successfully at 11:27 PM</p>
                                </div>
                                <div class="device-info">
                                    <span class="material-icons">smartphone</span>
                                    <span>iPhone 13 Pro • 192.168.1.45</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Mobile Floating Button removed as redundant -->
                </section>

                <!-- Attendance Logs Section (default active) -->
                <section id="attendance-logs" class="section active">
                    <div class="logs-header">
                        <div class="logs-header-left">
                            <h1 class="dashboard-title">Attendance Logs</h1>
                            <p class="dashboard-subtitle">View your attendance records per subject and section.</p>
                        </div>
                        <div class="logs-header-right">
                            <div class="filter-group">
                                <label for="filterRange" class="visually-hidden">Range</label>
                                <select id="filterRange" class="filter-select">
                                    <option selected>This Week</option>
                                    <option>This Month</option>
                                    <option>All Semester</option>
                                </select>
                            </div>
                            <div class="filter-group optional">
                                <label for="filterSubject" class="visually-hidden">Subject</label>
                                <select id="filterSubject" class="filter-select">
                                    <option selected>All Subjects</option>
                                    <option>Database Systems</option>
                                    <option>Web Development</option>
                                    <option>Data Structures</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="logs-grid">
                        <!-- Example log card -->
                        <article class="log-card">
                            <header class="log-card-row">
                                <div class="log-label">Subject</div>
                                <div class="log-value log-strong">Database Systems</div>
                            </header>
                            <div class="log-card-row">
                                <div class="log-label">Date</div>
                                <div class="log-value">Oct 17, 2025</div>
                            </div>
                            <div class="log-card-row">
                                <div class="log-label">Time In</div>
                                <div class="log-value">10:02 AM</div>
                            </div>
                            <div class="log-card-row">
                                <div class="log-label">Time Out</div>
                                <div class="log-value">11:30 AM</div>
                            </div>
                            <div class="log-card-row">
                                <div class="log-label">Room</div>
                                <div class="log-value">CICS 301</div>
                            </div>
                            <div class="log-card-row">
                                <div class="log-label">Status</div>
                                <div class="log-value"><span class="status-badge status-present">Present</span></div>
                            </div>
                        </article>

                        <article class="log-card log-accent">
                            <header class="log-card-row">
                                <div class="log-label">Subject</div>
                                <div class="log-value log-strong">Web Development</div>
                            </header>
                            <div class="log-card-row">
                                <div class="log-label">Date</div>
                                <div class="log-value">Oct 16, 2025</div>
                            </div>
                            <div class="log-card-row">
                                <div class="log-label">Time In</div>
                                <div class="log-value">10:12 AM</div>
                            </div>
                            <div class="log-card-row">
                                <div class="log-label">Time Out</div>
                                <div class="log-value">11:30 AM</div>
                            </div>
                            <div class="log-card-row">
                                <div class="log-label">Room</div>
                                <div class="log-value">CICS 305</div>
                            </div>
                            <div class="log-card-row">
                                <div class="log-label">Status</div>
                                <div class="log-value"><span class="status-badge status-late">Late</span></div>
                            </div>
                        </article>

                        <article class="log-card">
                            <header class="log-card-row">
                                <div class="log-label">Subject</div>
                                <div class="log-value log-strong">Data Structures</div>
                            </header>
                            <div class="log-card-row">
                                <div class="log-label">Date</div>
                                <div class="log-value">Oct 15, 2025</div>
                            </div>
                            <div class="log-card-row">
                                <div class="log-label">Time In</div>
                                <div class="log-value">—</div>
                            </div>
                            <div class="log-card-row">
                                <div class="log-label">Time Out</div>
                                <div class="log-value">—</div>
                            </div>
                            <div class="log-card-row">
                                <div class="log-label">Room</div>
                                <div class="log-value">CICS 204</div>
                            </div>
                            <div class="log-card-row">
                                <div class="log-label">Status</div>
                                <div class="log-value"><span class="status-badge status-absent">Absent</span></div>
                            </div>
                        </article>
                    </div>
                </section>

                <!-- Statistics Section -->
                <section id="statistics" class="section">
                    <div class="stats-header">
                        <div class="stats-header-content">
                            <h1 class="dashboard-title">Attendance Statistics</h1>
                            <p class="dashboard-subtitle">Visual summary of your attendance performance</p>
                        </div>
                        <div class="stats-filter-group">
                            <select class="filter-select">
                                <option selected>This Semester</option>
                                <option>This Month</option>
                                <option>This Week</option>
                            </select>
                        </div>
                    </div>

                    <!-- Quick Summary Cards -->
                    <div class="stats-summary-grid">
                        <div class="stat-card stat-present">
                            <div class="stat-icon-wrapper">
                                <span class="material-icons stat-icon">check_circle</span>
                            </div>
                            <div class="stat-content">
                                <div class="stat-value">42</div>
                                <div class="stat-label">Present Days</div>
                            </div>
                        </div>
                        <div class="stat-card stat-late">
                            <div class="stat-icon-wrapper">
                                <span class="material-icons stat-icon">schedule</span>
                            </div>
                            <div class="stat-content">
                                <div class="stat-value">5</div>
                                <div class="stat-label">Late Days</div>
                            </div>
                        </div>
                        <div class="stat-card stat-absent">
                            <div class="stat-icon-wrapper">
                                <span class="material-icons stat-icon">cancel</span>
                            </div>
                            <div class="stat-content">
                                <div class="stat-value">3</div>
                                <div class="stat-label">Absent Days</div>
                            </div>
                        </div>
                        <div class="stat-card stat-rate">
                            <div class="stat-icon-wrapper">
                                <span class="material-icons stat-icon">trending_up</span>
                            </div>
                            <div class="stat-content">
                                <div class="stat-value">91%</div>
                                <div class="stat-label">Attendance Rate</div>
                            </div>
                        </div>
                    </div>

                    <!-- Charts Grid -->
                    <div class="stats-charts-grid">
                        <!-- Attendance Overview Donut Chart -->
                        <div class="card chart-card">
                            <div class="card-header">
                                <h2 class="card-title">Attendance Overview</h2>
                                <span class="material-icons card-icon">donut_large</span>
                            </div>
                            <div class="card-content">
                                <div class="chart-wrapper">
                                    <canvas id="attendanceDonutChart"></canvas>
                                </div>
                                <div class="chart-legend">
                                    <div class="legend-item">
                                        <span class="legend-dot legend-present"></span>
                                        <span class="legend-label">Present (84%)</span>
                                    </div>
                                    <div class="legend-item">
                                        <span class="legend-dot legend-late"></span>
                                        <span class="legend-label">Late (10%)</span>
                                    </div>
                                    <div class="legend-item">
                                        <span class="legend-dot legend-absent"></span>
                                        <span class="legend-label">Absent (6%)</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Subject-wise Attendance Bar Chart -->
                        <div class="card chart-card">
                            <div class="card-header">
                                <h2 class="card-title">Attendance by Subject</h2>
                                <span class="material-icons card-icon">bar_chart</span>
                            </div>
                            <div class="card-content">
                                <div class="subject-bars">
                                    <div class="subject-bar-item">
                                        <div class="subject-bar-header">
                                            <span class="subject-name">Database Systems</span>
                                            <span class="subject-percentage">95%</span>
                                        </div>
                                        <div class="subject-bar-track">
                                            <div class="subject-bar-fill" style="width: 95%"></div>
                                        </div>
                                    </div>
                                    <div class="subject-bar-item">
                                        <div class="subject-bar-header">
                                            <span class="subject-name">Web Development</span>
                                            <span class="subject-percentage">82%</span>
                                        </div>
                                        <div class="subject-bar-track">
                                            <div class="subject-bar-fill" style="width: 82%"></div>
                                        </div>
                                    </div>
                                    <div class="subject-bar-item">
                                        <div class="subject-bar-header">
                                            <span class="subject-name">Data Structures</span>
                                            <span class="subject-percentage">100%</span>
                                        </div>
                                        <div class="subject-bar-track">
                                            <div class="subject-bar-fill" style="width: 100%"></div>
                                        </div>
                                    </div>
                                    <div class="subject-bar-item">
                                        <div class="subject-bar-header">
                                            <span class="subject-name">Computer Networks</span>
                                            <span class="subject-percentage">88%</span>
                                        </div>
                                        <div class="subject-bar-track">
                                            <div class="subject-bar-fill" style="width: 88%"></div>
                                        </div>
                                    </div>
                                    <div class="subject-bar-item">
                                        <div class="subject-bar-header">
                                            <span class="subject-name">Software Engineering</span>
                                            <span class="subject-percentage">92%</span>
                                        </div>
                                        <div class="subject-bar-track">
                                            <div class="subject-bar-fill" style="width: 92%"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Performance Insight Card -->
                        <div class="card insight-card">
                            <div class="insight-icon-wrapper">
                                <span class="material-icons insight-icon">lightbulb</span>
                            </div>
                            <div class="insight-content">
                                <h3 class="insight-title">Performance Insight</h3>
                                <p class="insight-text">You've maintained <strong>91% attendance</strong> this semester. Excellent work! Consider improving punctuality in <strong>Web Development</strong> where you have 3 late entries.</p>
                            </div>
                        </div>
                    </div>
                </section>

               <!-- Schedule Section -->
                <section id="schedule" class="section">
                    <!-- Next Class Reminder Widget -->
                    <div class="next-class-reminder">
                        <div class="reminder-icon">
                            <span class="material-icons">schedule</span>
                        </div>
                        <div class="reminder-content">
                            <div class="reminder-label">Next Class</div>
                            <div class="reminder-subject">Database Systems — 10:30 AM, Room 305</div>
                            <div class="reminder-time">Starts in 20 minutes</div>
                        </div>
                    </div>

                    <!-- Schedule Header -->
                    <div class="schedule-header">
                        <div class="schedule-header-left">
                            <h1 class="dashboard-title">My Class Schedule</h1>
                        </div>
                    </div>

                    <!-- Today's Schedule -->
                    <div class="schedule-content">
                        <div class="schedule-day-header">
                            <h2 class="schedule-day-title">Today's Classes</h2>
                            <span class="schedule-day-date">Friday, October 17, 2025</span>
                        </div>

                        <div class="schedule-cards-grid">
                            <!-- Ongoing Class Card -->
                            <article class="schedule-class-card status-ongoing">
                                <div class="class-card-status-bar"></div>
                                <div class="class-card-time">
                                    <span class="material-icons time-icon">schedule</span>
                                    <span class="time-range">9:00 AM – 10:30 AM</span>
                                    <span class="status-badge-schedule status-ongoing-badge">
                                        <span class="status-dot"></span>
                                        Ongoing
                                    </span>
                                </div>
                                <div class="class-card-details">
                                    <h3 class="class-card-subject">Web Programming</h3>
                                    <div class="class-card-info-row">
                                        <span class="material-icons info-icon">person</span>
                                        <span class="info-text">Prof. Maria Santos</span>
                                    </div>
                                    <div class="class-card-info-row">
                                        <span class="material-icons info-icon">location_on</span>
                                        <span class="info-text">Lab 204, CICS Building</span>
                                    </div>
                                </div>
                                
                            </article>

                            <!-- Upcoming Class Card -->
                            <article class="schedule-class-card status-upcoming">
                                <div class="class-card-status-bar"></div>
                                <div class="class-card-time">
                                    <span class="material-icons time-icon">schedule</span>
                                    <span class="time-range">10:30 AM – 12:00 PM</span>
                                    <span class="status-badge-schedule status-upcoming-badge">
                                        <span class="status-dot"></span>
                                        Upcoming
                                    </span>
                                </div>
                                <div class="class-card-details">
                                    <h3 class="class-card-subject">Database Systems</h3>
                                    <div class="class-card-info-row">
                                        <span class="material-icons info-icon">person</span>
                                        <span class="info-text">Dr. Ramon Cruz</span>
                                    </div>
                                    <div class="class-card-info-row">
                                        <span class="material-icons info-icon">location_on</span>
                                        <span class="info-text">Room 305, CICS Building</span>
                                    </div>
                                </div>
                                
                            </article>

                            <!-- Upcoming Class Card 2 -->
                            <article class="schedule-class-card status-upcoming">
                                <div class="class-card-status-bar"></div>
                                <div class="class-card-time">
                                    <span class="material-icons time-icon">schedule</span>
                                    <span class="time-range">1:00 PM – 2:30 PM</span>
                                    <span class="status-badge-schedule status-upcoming-badge">
                                        <span class="status-dot"></span>
                                        Upcoming
                                    </span>
                                </div>
                                <div class="class-card-details">
                                    <h3 class="class-card-subject">Software Engineering</h3>
                                    <div class="class-card-info-row">
                                        <span class="material-icons info-icon">person</span>
                                        <span class="info-text">Engr. Jose Reyes</span>
                                    </div>
                                    <div class="class-card-info-row">
                                        <span class="material-icons info-icon">location_on</span>
                                        <span class="info-text">Room 201, CICS Building</span>
                                    </div>
                                </div>
                                
                            </article>

                            <!-- Completed Class Card -->
                            <article class="schedule-class-card status-completed">
                                <div class="class-card-status-bar"></div>
                                <div class="class-card-time">
                                    <span class="material-icons time-icon">schedule</span>
                                    <span class="time-range">7:30 AM – 9:00 AM</span>
                                    <span class="status-badge-schedule status-completed-badge">
                                        <span class="status-dot"></span>
                                        Completed
                                    </span>
                                </div>
                                <div class="class-card-details">
                                    <h3 class="class-card-subject">Engineering Drawing</h3>
                                    <div class="class-card-info-row">
                                        <span class="material-icons info-icon">person</span>
                                        <span class="info-text">Engr. Ana Garcia</span>
                                    </div>
                                    <div class="class-card-info-row">
                                        <span class="material-icons info-icon">location_on</span>
                                        <span class="info-text">Lab 102, Engineering Building</span>
                                    </div>
                                </div>
                                <div class="class-card-actions">
                                    <div class="attendance-status-info">
                                        <span class="material-icons status-check-icon">check_circle</span>
                                        <span class="status-text">Attendance Recorded</span>
                                    </div>
                                </div>
                            </article>
                        </div>
                    </div>

                    <!-- Weekly Schedule Section -->
                    <div class="weekly-schedule-section">
                        <div class="schedule-day-header">
                            <h2 class="schedule-day-title">Weekly Schedule</h2>
                        </div>

                        <div class="weekly-schedule-grid">
                            <!-- Monday -->
                            <div class="weekly-day-card">
                                <div class="day-header">
                                    <h3 class="day-name">Monday</h3>
                                    <span class="day-date">Oct 13</span>
                                </div>
                                <div class="day-classes">
                                    <div class="weekly-class-item">
                                        <div class="class-time">9:00 AM - 10:30 AM</div>
                                        <div class="class-name">Web Programming</div>
                                        <div class="class-location">Lab 204</div>
                                    </div>
                                    <div class="weekly-class-item">
                                        <div class="class-time">1:00 PM - 2:30 PM</div>
                                        <div class="class-name">Engineering Drawing</div>
                                        <div class="class-location">Lab 102</div>
                                    </div>
                                </div>
                            </div>

                            <!-- Tuesday -->
                            <div class="weekly-day-card">
                                <div class="day-header">
                                    <h3 class="day-name">Tuesday</h3>
                                    <span class="day-date">Oct 14</span>
                                </div>
                                <div class="day-classes">
                                    <div class="weekly-class-item">
                                        <div class="class-time">10:30 AM - 12:00 PM</div>
                                        <div class="class-name">Database Systems</div>
                                        <div class="class-location">Room 305</div>
                                    </div>
                                    <div class="weekly-class-item">
                                        <div class="class-time">2:30 PM - 4:00 PM</div>
                                        <div class="class-name">Data Structures</div>
                                        <div class="class-location">Lab 204</div>
                                    </div>
                                </div>
                            </div>

                            <!-- Wednesday -->
                            <div class="weekly-day-card">
                                <div class="day-header">
                                    <h3 class="day-name">Wednesday</h3>
                                    <span class="day-date">Oct 15</span>
                                </div>
                                <div class="day-classes">
                                    <div class="weekly-class-item">
                                        <div class="class-time">7:30 AM - 9:00 AM</div>
                                        <div class="class-name">AutoCAD</div>
                                        <div class="class-location">Lab 103</div>
                                    </div>
                                    <div class="weekly-class-item">
                                        <div class="class-time">9:00 AM - 10:30 AM</div>
                                        <div class="class-name">Web Programming</div>
                                        <div class="class-location">Lab 204</div>
                                    </div>
                                    <div class="weekly-class-item">
                                        <div class="class-time">1:00 PM - 2:30 PM</div>
                                        <div class="class-name">Software Engineering</div>
                                        <div class="class-location">Room 201</div>
                                    </div>
                                </div>
                            </div>

                            <!-- Thursday -->
                            <div class="weekly-day-card">
                                <div class="day-header">
                                    <h3 class="day-name">Thursday</h3>
                                    <span class="day-date">Oct 16</span>
                                </div>
                                <div class="day-classes">
                                    <div class="weekly-class-item">
                                        <div class="class-time">10:30 AM - 12:00 PM</div>
                                        <div class="class-name">Computer Networks</div>
                                        <div class="class-location">Lab 301</div>
                                    </div>
                                    <div class="weekly-class-item">
                                        <div class="class-time">1:00 PM - 2:30 PM</div>
                                        <div class="class-name">Engineering Drawing</div>
                                        <div class="class-location">Lab 102</div>
                                    </div>
                                </div>
                            </div>

                            <!-- Friday (Today) -->
                            <div class="weekly-day-card today-highlight">
                                <div class="day-header">
                                    <h3 class="day-name">Friday</h3>
                                    <span class="day-date">Oct 17</span>
                                    <span class="today-badge">Today</span>
                                </div>
                                <div class="day-classes">
                                    <div class="weekly-class-item">
                                        <div class="class-time">7:30 AM - 9:00 AM</div>
                                        <div class="class-name">Engineering Drawing</div>
                                        <div class="class-location">Lab 102</div>
                                    </div>
                                    <div class="weekly-class-item">
                                        <div class="class-time">9:00 AM - 10:30 AM</div>
                                        <div class="class-name">Web Programming</div>
                                        <div class="class-location">Lab 204</div>
                                    </div>
                                    <div class="weekly-class-item">
                                        <div class="class-time">10:30 AM - 12:00 PM</div>
                                        <div class="class-name">Database Systems</div>
                                        <div class="class-location">Room 305</div>
                                    </div>
                                    <div class="weekly-class-item">
                                        <div class="class-time">1:00 PM - 2:30 PM</div>
                                        <div class="class-name">Software Engineering</div>
                                        <div class="class-location">Room 201</div>
                                    </div>
                                </div>
                            </div>

                            <!-- Saturday -->
                            <div class="weekly-day-card">
                                <div class="day-header">
                                    <h3 class="day-name">Saturday</h3>
                                    <span class="day-date">Oct 18</span>
                                </div>
                                <div class="day-classes">
                                    <div class="weekly-class-item">
                                        <div class="class-time">9:00 AM - 11:00 AM</div>
                                        <div class="class-name">Laboratory Session</div>
                                        <div class="class-location">Lab 204</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Requests Section -->
                <section id="requests" class="section">
                    <!-- Request Header -->
                    <div class="request-header">
                        <div class="request-header-left">
                            <h1 class="request-title">📩 My Requests</h1>
                            <p class="request-subtitle">Submit and track your attendance or device concerns.</p>
                        </div>
                        <button class="new-request-btn" id="newRequestBtn">
                            <span class="material-icons">add</span>
                            New Request
                        </button>
                    </div>

                    <!-- Request List -->
                    <div class="request-list">
                        <!-- Sample Request Card 1 -->
                        <div class="request-card">
                            <div class="request-card-header">
                                <div class="request-info">
                                    <h3 class="request-subject">📘 Database Systems</h3>
                                    <div class="request-meta">
                                        <span class="request-date">🗓️ Oct 16, 2025</span>
                                        <span class="request-type">💬 Missed Time-In</span>
                                    </div>
                                </div>
                                <div class="request-status status-pending">
                                    <span class="status-dot"></span>
                                    Pending
                                </div>
                            </div>
                            <div class="request-description">
                                📄 I was present in class but my attendance did not record.
                            </div>
                            <div class="request-actions">
                                <button class="view-details-btn">View Details</button>
                                <span class="request-id">#REQ-001</span>
                            </div>
                        </div>

                        <!-- Sample Request Card 2 -->
                        <div class="request-card">
                            <div class="request-card-header">
                                <div class="request-info">
                                    <h3 class="request-subject">📱 Device Registration</h3>
                                    <div class="request-meta">
                                        <span class="request-date">🗓️ Oct 15, 2025</span>
                                        <span class="request-type">💬 Registration Issue</span>
                                    </div>
                                </div>
                                <div class="request-status status-approved">
                                    <span class="status-dot"></span>
                                    Approved
                                </div>
                            </div>
                            <div class="request-description">
                                📄 Unable to register my new iPhone for attendance tracking.
                            </div>
                            <div class="request-actions">
                                <button class="view-details-btn">View Details</button>
                                <span class="request-id">#REQ-002</span>
                            </div>
                            <div class="admin-response">
                                <div class="admin-note">
                                    <strong>📝 Admin Note:</strong> Device registered successfully. Please restart the app.
                                </div>
                            </div>
                        </div>

                        <!-- Sample Request Card 3 -->
                        <div class="request-card">
                            <div class="request-card-header">
                                <div class="request-info">
                                    <h3 class="request-subject">📚 Software Engineering</h3>
                                    <div class="request-meta">
                                        <span class="request-date">🗓️ Oct 14, 2025</span>
                                        <span class="request-type">💬 Absence Notice</span>
                                    </div>
                                </div>
                                <div class="request-status status-rejected">
                                    <span class="status-dot"></span>
                                    Rejected
                                </div>
                            </div>
                            <div class="request-description">
                                📄 Medical appointment during class hours. Requesting excuse.
                            </div>
                            <div class="request-actions">
                                <button class="view-details-btn">View Details</button>
                                <span class="request-id">#REQ-003</span>
                            </div>
                            <div class="admin-response">
                                <div class="admin-note">
                                    <strong>📝 Admin Note:</strong> Medical certificate required for excused absence.
                                </div>
                            </div>
                        </div>

                        <!-- Empty State (when no requests) -->
                        <div class="empty-requests" style="display: none;">
                            <div class="empty-icon">📝</div>
                            <h3>No Requests Yet</h3>
                            <p>You haven't submitted any requests. Click "New Request" to get started.</p>
                        </div>
                    </div>

                    <!-- Mobile Floating Button -->
                    <button class="mobile-floating-btn" id="mobileNewRequestBtn">
                        <span class="material-icons">add</span>
                    </button>
                </section>

                <!-- New Request Modal -->
                <div class="modal-overlay" id="requestModal">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h2 class="modal-title">📩 New Request</h2>
                            <button class="modal-close" id="closeModal">
                                <span class="material-icons">close</span>
                            </button>
                        </div>
                        <form class="request-form" id="requestForm">
                            <div class="form-group">
                                <label for="requestType">Request Type</label>
                                <select id="requestType" name="requestType" required>
                                    <option value="">Select request type...</option>
                                    <option value="attendance">☐ Attendance Correction</option>
                                    <option value="device">☐ Device Registration Issue</option>
                                    <option value="absence">☐ Absence Notice</option>
                                    <option value="other">☐ Other Concern</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="subject">Select Subject</label>
                                <select id="subject" name="subject" required>
                                    <option value="">Select subject...</option>
                                    <option value="web-programming">Web Programming</option>
                                    <option value="database-systems">Database Systems</option>
                                    <option value="software-engineering">Software Engineering</option>
                                    <option value="data-structures">Data Structures</option>
                                    <option value="computer-networks">Computer Networks</option>
                                    <option value="autocad">AutoCAD</option>
                                    <option value="engineering-drawing">Engineering Drawing</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="concernDate">Date of Concern</label>
                                <input type="date" id="concernDate" name="concernDate" required>
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea id="description" name="description" rows="4" placeholder="Explain the issue briefly..." required></textarea>
                            </div>
                            <div class="form-actions">
                                <button type="button" class="cancel-btn" id="cancelBtn">
                                    <span class="material-icons">close</span>
                                    Cancel
                                </button>
                                <button type="submit" class="submit-btn">
                                    <span class="material-icons">send</span>
                                    Submit Request
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Profile Section -->
                <section id="profile" class="section">
                    <!-- Profile Header -->
                    <div class="profile-header">
                        <h1 class="profile-title">👤 My Profile</h1>
                        <p class="profile-subtitle">Manage your personal and academic information.</p>
                    </div>

                    <!-- Profile Summary Card -->
                    <div class="profile-summary-card">
                        <div class="profile-avatar-section">
                            <div class="profile-avatar">
                                <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=150&h=150&fit=crop&crop=face" alt="Profile Photo" class="avatar-image" id="avatarImage">
                                <div class="avatar-overlay">
                                    <span class="material-icons">camera_alt</span>
                                </div>
                            </div>
                            <button class="update-photo-btn" id="updatePhotoBtn">
                                <span class="material-icons">camera_alt</span>
                                Update Photo
                            </button>
                        </div>
                        <div class="profile-info">
                            <h2 class="profile-name">John Christian</h2>
                            <p class="profile-program">BS Information Technology 3B</p>
                            <div class="profile-contact">
                                <div class="contact-item">
                                    <span class="material-icons">email</span>
                                    <span>johnchristian@zppsu.edu.ph</span>
                                </div>
                                <div class="contact-item">
                                    <span class="material-icons">phone</span>
                                    <span>+63 912 345 6789</span>
                                </div>
                            </div>
                        </div>
                        <div class="profile-actions">
                            <button class="edit-profile-btn" id="editProfileBtn">
                                <span class="material-icons">edit</span>
                                Edit Profile
                            </button>
                        </div>
                    </div>



                    <!-- Device Information Section -->
                    <div class="profile-section">
                        <div class="section-header">
                            <h3 class="section-title">Device Information</h3>
                            <div class="section-actions">
                                <button class="reregister-btn" id="reregisterDeviceBtn">
                                    <span class="material-icons">refresh</span>
                                    Change Device
                                </button>
                            </div>
                        </div>
                        <div class="info-card">
                            <div class="device-info">
                                <div class="device-main">
                                    <div class="device-icon">
                                        <span class="material-icons">smartphone</span>
                                    </div>
                                    <div class="device-details">
                                        <h4 class="device-name">📱 iPhone 13 Pro</h4>
                                        <div class="device-meta">
                                            <span class="device-ip">🌐 192.168.1.45</span>
                                            <span class="device-status status-active">
                                                <span class="status-dot"></span>
                                                Active
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="device-activity">
                                    <div class="activity-item">
                                        <span class="material-icons">access_time</span>
                                        <div class="activity-info">
                                            <span class="activity-label">Last Attendance Log</span>
                                            <span class="activity-time">11:27 PM - Today</span>
                                        </div>
                                    </div>
                                    <div class="activity-item">
                                        <span class="material-icons">location_on</span>
                                        <div class="activity-info">
                                            <span class="activity-label">Last Location</span>
                                            <span class="activity-location">Room 305, CICS Building</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Photo Upload Modal -->
                <div class="modal-overlay" id="photoModal">
                    <div class="modal-content photo-modal">
                        <div class="modal-header">
                            <h2 class="modal-title">📷 Update Profile Photo</h2>
                            <button class="modal-close" id="closePhotoModal">
                                <span class="material-icons">close</span>
                            </button>
                        </div>
                        <div class="photo-upload-content">
                            <div class="upload-area" id="uploadArea">
                                <div class="upload-icon">
                                    <span class="material-icons">cloud_upload</span>
                                </div>
                                <p class="upload-text">Click to upload or drag and drop</p>
                                <p class="upload-hint">PNG, JPG up to 5MB</p>
                                <input type="file" id="photoInput" accept="image/*" style="display: none;">
                            </div>
                            <div class="photo-preview" id="photoPreview" style="display: none;">
                                <img id="previewImage" alt="Preview">
                                <button class="remove-photo" id="removePhoto">
                                    <span class="material-icons">delete</span>
                                </button>
                            </div>
                            <div class="photo-actions">
                                <button class="cancel-btn" id="cancelPhotoBtn">Cancel</button>
                                <button class="upload-btn" id="uploadPhotoBtn" disabled>
                                    <span class="material-icons">upload</span>
                                    Upload Photo
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Settings Section -->
                <section id="settings" class="section">
                    <div class="dashboard-header">
                        <h1 class="dashboard-title">Settings</h1>
                        <p class="dashboard-subtitle">Update preferences and security</p>
                    </div>
                    <div class="dashboard-cards">
                        <div class="card">
                            <div class="card-header">
                                <h2 class="card-title">Preferences</h2>
                                <span class="material-icons card-icon">settings</span>
                            </div>
                            <div class="card-content">
                                <p>Settings content placeholder.</p>
                            </div>
                        </div>
                    </div>
                </section>
            </main>
        </div>

        <!-- Mobile Menu -->
        <div class="mobile-menu" id="mobileMenu">
            <div class="mobile-menu-backdrop" id="mobileMenuBackdrop"></div>
            <div class="mobile-menu-panel">
                <div class="mobile-menu-header">
                    <div class="mobile-logo">
                        <img src="https://uploadthingy.s3.us-west-1.amazonaws.com/gaDEujMGhH3qGpTeHVVFhi/ZPPUS-CICS_LOGO.jpg" alt="CICS Logo" class="logo">
                        <span class="logo-text">CICS Attendance</span>
                    </div>
                    <button class="mobile-menu-close" id="mobileMenuClose" aria-label="Close menu">
                        <span class="material-icons">close</span>
                    </button>
                </div>
                <nav class="mobile-nav">
                    <a href="#dashboard" class="mobile-nav-item active">
                        <span class="material-icons">home</span>
                        <span class="nav-text">Dashboard</span>
                    </a>
                    <a href="#attendance-logs" class="mobile-nav-item">
                        <span class="material-icons">checklist</span>
                        <span class="nav-text">Attendance Logs</span>
                    </a>
                    <a href="#statistics" class="mobile-nav-item">
                        <span class="material-icons">bar_chart</span>
                        <span class="nav-text">Statistics</span>
                    </a>
                    <a href="#schedule" class="mobile-nav-item">
                        <span class="material-icons">calendar_today</span>
                        <span class="nav-text">Schedule</span>
                    </a>
                    <a href="#requests" class="mobile-nav-item">
                        <span class="material-icons">description</span>
                        <span class="nav-text">Requests</span>
                    </a>
                    <a href="#profile" class="mobile-nav-item">
                        <span class="material-icons">person</span>
                        <span class="nav-text">My Profile</span>
                    </a>
                    <a href="#settings" class="mobile-nav-item">
                        <span class="material-icons">settings</span>
                        <span class="nav-text">Settings</span>
                    </a>
                    <a href="#logout" class="mobile-nav-item logout-item">
                        <span class="material-icons">logout</span>
                        <span class="nav-text">Logout</span>
                    </a>
                </nav>
                <div class="mobile-user-info">
                    <div class="user-avatar">JC</div>
                    <div class="user-details">
                        <p class="user-name">John Christian</p>
                        <p class="user-course">BS-Infotech 3B</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <footer class="footer">
            <p>
                CICS Attendance System © 2025 — Zamboanga Peninsula Polytechnic State University
            </p>
        </footer>
    </div>

    <script>
        // Mobile menu + section navigation
        document.addEventListener('DOMContentLoaded', function() {
            const mobileMenuToggle = document.getElementById('mobileMenuToggle');
            const mobileMenu = document.getElementById('mobileMenu');
            const mobileMenuClose = document.getElementById('mobileMenuClose');
            const mobileMenuBackdrop = document.getElementById('mobileMenuBackdrop');
            const sidebarLinks = Array.from(document.querySelectorAll('.sidebar .nav-item'));
            const mobileLinks = Array.from(document.querySelectorAll('.mobile-nav .mobile-nav-item'));
            const sections = {
                'dashboard': document.getElementById('dashboard'),
                'attendance-logs': document.getElementById('attendance-logs'),
                'statistics': document.getElementById('statistics'),
                'schedule': document.getElementById('schedule'),
                'requests': document.getElementById('requests'),
                'profile': document.getElementById('profile'),
                'settings': document.getElementById('settings')
            };
            
            function openMobileMenu() {
                mobileMenu.classList.add('open');
            }
            
            function closeMobileMenu() {
                mobileMenu.classList.remove('open');
            }
            
            mobileMenuToggle.addEventListener('click', openMobileMenu);
            mobileMenuClose.addEventListener('click', closeMobileMenu);
            mobileMenuBackdrop.addEventListener('click', closeMobileMenu);
            
            function setActiveNav(target) {
                const allLinks = sidebarLinks.concat(mobileLinks);
                allLinks.forEach(link => {
                    const href = link.getAttribute('href') || '';
                    const key = href.startsWith('#') ? href.substring(1) : href;
                    if (key === target) {
                        link.classList.add('active');
                    } else {
                        link.classList.remove('active');
                    }
                });
            }

            function showSection(target) {
                Object.keys(sections).forEach(key => {
                    const el = sections[key];
                    if (!el) return;
                    if (key === target) {
                        el.classList.add('active');
                    } else {
                        el.classList.remove('active');
                    }
                });
                setActiveNav(target);
                if (mobileMenu.classList.contains('open')) closeMobileMenu();
            }

            function handleNavClick(event) {
                const href = event.currentTarget.getAttribute('href');
                if (!href || !href.startsWith('#')) return;
                event.preventDefault();
                const target = href.substring(1);
                if (sections[target]) {
                    history.replaceState(null, '', '#' + target);
                    showSection(target);
                }
            }

            sidebarLinks.forEach(a => a.addEventListener('click', handleNavClick));
            mobileLinks.forEach(a => a.addEventListener('click', handleNavClick));

            // Initialize: prefer URL hash, else default to attendance-logs
            const initial = (location.hash && location.hash.substring(1)) || 'attendance-logs';
            if (sections[initial]) {
                showSection(initial);
            } else {
                showSection('attendance-logs');
            }
            
            // Dropdown removed; no toggle needed
            
            // Request Modal Functionality
            const requestModal = document.getElementById('requestModal');
            const newRequestBtn = document.getElementById('newRequestBtn');
            const mobileNewRequestBtn = document.getElementById('mobileNewRequestBtn');
            const closeModal = document.getElementById('closeModal');
            const cancelBtn = document.getElementById('cancelBtn');
            const requestForm = document.getElementById('requestForm');

            // Open modal
            function openRequestModal() {
                requestModal.classList.add('active');
                document.body.style.overflow = 'hidden';
            }

            // Close modal
            function closeRequestModal() {
                requestModal.classList.remove('active');
                document.body.style.overflow = '';
                requestForm.reset();
            }

            // Event listeners for modal
            if (newRequestBtn) newRequestBtn.addEventListener('click', openRequestModal);
            if (mobileNewRequestBtn) mobileNewRequestBtn.addEventListener('click', openRequestModal);
            if (closeModal) closeModal.addEventListener('click', closeRequestModal);
            if (cancelBtn) cancelBtn.addEventListener('click', closeRequestModal);

            // Close modal when clicking outside
            requestModal.addEventListener('click', (e) => {
                if (e.target === requestModal) {
                    closeRequestModal();
                }
            });

            // Handle form submission
            requestForm.addEventListener('submit', (e) => {
                e.preventDefault();
                
                // Get form data
                const formData = new FormData(requestForm);
                const requestData = {
                    type: formData.get('requestType'),
                    subject: formData.get('subject'),
                    date: formData.get('concernDate'),
                    description: formData.get('description')
                };

                // Here you would normally send the data to your backend
                console.log('Request submitted:', requestData);
                
                // Show success message (you can customize this)
                alert('Request submitted successfully! You will receive a notification when it\'s reviewed.');
                
                // Close modal and reset form
                closeRequestModal();
                
                // Optionally refresh the request list or add the new request to the UI
                // addNewRequestToList(requestData);
            });

            // View Details functionality
            document.querySelectorAll('.view-details-btn').forEach(btn => {
                btn.addEventListener('click', (e) => {
                    const requestCard = e.target.closest('.request-card');
                    const requestId = requestCard.querySelector('.request-id').textContent;
                    
                    // Here you would show detailed view of the request
                    console.log('View details for:', requestId);
                    alert(`Viewing details for ${requestId}`);
                });
            });

            // Close modal with Escape key
            document.addEventListener('keydown', (e) => {
                if (e.key === 'Escape' && requestModal.classList.contains('active')) {
                    closeRequestModal();
                }
            });

            // Profile Section Functionality
            const editProfileBtn = document.getElementById('editProfileBtn');
            const updatePhotoBtn = document.getElementById('updatePhotoBtn');
            const photoModal = document.getElementById('photoModal');
            const closePhotoModal = document.getElementById('closePhotoModal');
            const cancelPhotoBtn = document.getElementById('cancelPhotoBtn');
            const uploadArea = document.getElementById('uploadArea');
            const photoInput = document.getElementById('photoInput');
            const photoPreview = document.getElementById('photoPreview');
            const previewImage = document.getElementById('previewImage');
            const removePhoto = document.getElementById('removePhoto');
            const uploadPhotoBtn = document.getElementById('uploadPhotoBtn');
            const avatarImage = document.getElementById('avatarImage');
            const reregisterDeviceBtn = document.getElementById('reregisterDeviceBtn');

            let selectedFile = null;

            // Photo Upload Functionality
            function openPhotoModal() {
                photoModal.classList.add('active');
                document.body.style.overflow = 'hidden';
            }

            function closePhotoModalFunc() {
                photoModal.classList.remove('active');
                document.body.style.overflow = '';
                resetPhotoUpload();
            }

            function resetPhotoUpload() {
                selectedFile = null;
                photoInput.value = '';
                photoPreview.style.display = 'none';
                uploadArea.style.display = 'block';
                uploadPhotoBtn.disabled = true;
            }

            function handleFileSelect(file) {
                if (file && file.type.startsWith('image/')) {
                    if (file.size > 5 * 1024 * 1024) { // 5MB limit
                        alert('File size must be less than 5MB');
                        return;
                    }
                    
                    selectedFile = file;
                    const reader = new FileReader();
                    
                    reader.onload = (e) => {
                        previewImage.src = e.target.result;
                        photoPreview.style.display = 'block';
                        uploadArea.style.display = 'none';
                        uploadPhotoBtn.disabled = false;
                    };
                    
                    reader.readAsDataURL(file);
                }
            }

            function uploadPhoto() {
                if (selectedFile) {
                    // Here you would upload to your backend
                    console.log('Uploading photo:', selectedFile.name);
                    
                    // Simulate upload and update avatar
                    const reader = new FileReader();
                    reader.onload = (e) => {
                        avatarImage.src = e.target.result;
                        closePhotoModalFunc();
                        alert('Profile photo updated successfully!');
                    };
                    reader.readAsDataURL(selectedFile);
                }
            }

            // Device Change
            function reregisterDevice() {
                if (confirm('Are you sure you want to change your device? This will require you to set up attendance tracking again.')) {
                    // Here you would handle device change
                    console.log('Changing device...');
                    alert('Device change initiated. Please follow the setup instructions.');
                }
            }

            // Event Listeners
            if (updatePhotoBtn) updatePhotoBtn.addEventListener('click', openPhotoModal);
            if (closePhotoModal) closePhotoModal.addEventListener('click', closePhotoModalFunc);
            if (cancelPhotoBtn) cancelPhotoBtn.addEventListener('click', closePhotoModalFunc);
            if (uploadPhotoBtn) uploadPhotoBtn.addEventListener('click', uploadPhoto);
            if (removePhoto) removePhoto.addEventListener('click', resetPhotoUpload);
            if (reregisterDeviceBtn) reregisterDeviceBtn.addEventListener('click', reregisterDevice);

            // Photo upload area interactions
            if (uploadArea) {
                uploadArea.addEventListener('click', () => photoInput.click());
                
                uploadArea.addEventListener('dragover', (e) => {
                    e.preventDefault();
                    uploadArea.classList.add('dragover');
                });
                
                uploadArea.addEventListener('dragleave', () => {
                    uploadArea.classList.remove('dragover');
                });
                
                uploadArea.addEventListener('drop', (e) => {
                    e.preventDefault();
                    uploadArea.classList.remove('dragover');
                    const files = e.dataTransfer.files;
                    if (files.length > 0) {
                        handleFileSelect(files[0]);
                    }
                });
            }

            if (photoInput) {
                photoInput.addEventListener('change', (e) => {
                    if (e.target.files.length > 0) {
                        handleFileSelect(e.target.files[0]);
                    }
                });
            }

            // Close photo modal when clicking outside
            if (photoModal) {
                photoModal.addEventListener('click', (e) => {
                    if (e.target === photoModal) {
                        closePhotoModalFunc();
                    }
                });
            }

            // Close photo modal with Escape key
            document.addEventListener('keydown', (e) => {
                if (e.key === 'Escape' && photoModal.classList.contains('active')) {
                    closePhotoModalFunc();
                }
            });
        });
    </script>
</body>
</html>