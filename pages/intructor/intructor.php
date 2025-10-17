<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Instructor Dashboard - CICS Attendance Management</title>
    <link rel="stylesheet" href="shared-sidebar.css">
    <link rel="stylesheet" href="intructor.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&family=Montserrat:wght@400;500;600&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/lucide/1.0.0/lucide.min.css" rel="stylesheet">
</head>
<body>
    <?php include 'sidebar-include.php'; ?>

    <!-- Header -->
    <header class="header">
        <div class="container">
            <div class="header-content">
                <div class="logo">
                    <button class="mobile-menu-btn" id="mobileMenuBtn" aria-label="Toggle navigation menu" aria-expanded="false" aria-controls="sidebar">
                        <i data-lucide="menu" aria-hidden="true"></i>
                    </button>
                    <div class="logo-icon">
                        <i data-lucide="graduation-cap" aria-hidden="true"></i>
                    </div>
                    <div class="logo-text">
                        <span class="logo-primary">CICS</span>
                        <span class="logo-secondary">DASHBOARD</span>
                    </div>
                </div>
                
                <!-- User Menu -->
                <div class="user-menu">
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
        <div class="container">
            <!-- Page Header -->
            <div class="page-header">
                <div class="page-title">
                    <h1>Instructor Dashboard</h1>
                    <p>Manage your classes and track student attendance</p>
                </div>
                <div class="page-actions">
                    <button class="btn btn-secondary">
                        <i data-lucide="download"></i>
                        Export Data
                    </button>
                    <button class="btn btn-primary" id="startSessionBtn">
                        <i data-lucide="play"></i>
                        Start Session
                    </button>
                </div>
            </div>

            <!-- Dashboard Grid -->
            <div class="dashboard-grid">
                <!-- Left Column -->
                <div class="dashboard-left">
                    <!-- Attendance Session Card -->
                    <div class="card session-card">
                        <div class="card-header">
                            <div class="card-title">
                                <i data-lucide="clock" class="card-icon"></i>
                                <h2>Attendance Session</h2>
                            </div>
                            <div class="session-status" id="sessionStatus">
                                <span class="status-indicator inactive"></span>
                                Inactive
                            </div>
                        </div>
                        
                        <div class="card-content">
                            <div class="session-form">
                                <div class="form-grid">
                                    <div class="form-group">
                                        <label class="form-label">Class</label>
                                        <select class="form-select" id="classSelect">
                                            <option>CS 101 - Introduction to Programming</option>
                                            <option>CS 202 - Data Structures</option>
                                            <option>CS 305 - Algorithm Design</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Section</label>
                                        <select class="form-select" id="sectionSelect">
                                            <option>A - Morning</option>
                                            <option>B - Afternoon</option>
                                            <option>C - Evening</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Room</label>
                                        <select class="form-select" id="roomSelect">
                                            <option>Room 101</option>
                                            <option>Lab 3</option>
                                            <option>Lecture Hall B</option>
                                        </select>
                                    </div>
                                </div>
                                
                                <!-- Session Progress -->
                                <div class="session-progress hidden" id="sessionProgress">
                                    <div class="progress-info">
                                        <div class="progress-text">
                                            <span class="progress-label">Session Active</span>
                                            <span class="progress-time" id="startTime">Started at 09:30 AM</span>
                                        </div>
                                        <div class="session-timer" id="sessionTimer">00:00:00</div>
                                    </div>
                                    <div class="progress-stats">
                                        <div class="stat-item">
                                            <span class="stat-value" id="presentCount">0</span>
                                            <span class="stat-label">Present</span>
                                        </div>
                                        <div class="stat-item">
                                            <span class="stat-value" id="lateCount">0</span>
                                            <span class="stat-label">Late</span>
                                        </div>
                                        <div class="stat-item">
                                            <span class="stat-value" id="absentCount">0</span>
                                            <span class="stat-label">Absent</span>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="session-actions">
                                    <button class="btn btn-primary btn-large" id="startSession">
                                        <i data-lucide="play"></i>
                                        Start Attendance Session
                                    </button>
                                    <button class="btn btn-danger btn-large hidden" id="endSession">
                                        <i data-lucide="stop-circle"></i>
                                        End Session
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Attendance Logs -->
                    <div class="card logs-card">
                        <div class="card-header">
                            <div class="card-title">
                                <i data-lucide="file-text" class="card-icon"></i>
                                <h2>Attendance Logs</h2>
                            </div>
                            <div class="card-actions">
                                <button class="btn btn-sm btn-secondary">
                                    <i data-lucide="filter"></i>
                                    Filter
                                </button>
                                <button class="btn btn-sm btn-secondary">
                                    <i data-lucide="printer"></i>
                                    Print
                                </button>
                                <button class="btn btn-sm btn-primary">
                                    <i data-lucide="download"></i>
                                    Export
                                </button>
                            </div>
                        </div>
                        
                        <div class="card-content">
                            <div class="table-container">
                                <table class="attendance-table">
                                    <thead>
                                        <tr>
                                            <th>Student</th>
                                            <th>ID</th>
                                            <th>Time In</th>
                                            <th>Time Out</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <div class="student-info">
                                                    <div class="student-avatar">
                                                        <i data-lucide="user"></i>
                                                    </div>
                                                    <span class="student-name">John Smith</span>
                                                </div>
                                            </td>
                                            <td>2023001</td>
                                            <td>09:15 AM</td>
                                            <td>10:45 AM</td>
                                            <td><span class="status-badge present">Present</span></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="student-info">
                                                    <div class="student-avatar">
                                                        <i data-lucide="user"></i>
                                                    </div>
                                                    <span class="student-name">Emily Johnson</span>
                                                </div>
                                            </td>
                                            <td>2023002</td>
                                            <td>09:10 AM</td>
                                            <td>10:45 AM</td>
                                            <td><span class="status-badge present">Present</span></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="student-info">
                                                    <div class="student-avatar">
                                                        <i data-lucide="user"></i>
                                                    </div>
                                                    <span class="student-name">Michael Brown</span>
                                                </div>
                                            </td>
                                            <td>2023003</td>
                                            <td>09:32 AM</td>
                                            <td>10:45 AM</td>
                                            <td><span class="status-badge late">Late</span></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="student-info">
                                                    <div class="student-avatar">
                                                        <i data-lucide="user"></i>
                                                    </div>
                                                    <span class="student-name">Jessica Davis</span>
                                                </div>
                                            </td>
                                            <td>2023004</td>
                                            <td>-</td>
                                            <td>-</td>
                                            <td><span class="status-badge absent">Absent</span></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            
                            <div class="table-pagination">
                                <div class="pagination-info">
                                    Showing 4 of 25 students
                                </div>
                                <div class="pagination-controls">
                                    <button class="btn btn-sm btn-secondary">Previous</button>
                                    <button class="btn btn-sm btn-primary">Next</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Column -->
                <div class="dashboard-right">
                    <!-- Quick Stats -->
                    <div class="stats-grid">
                        <div class="stat-card">
                            <div class="stat-icon success">
                                <i data-lucide="users"></i>
                            </div>
                            <div class="stat-content">
                                <div class="stat-value">92%</div>
                                <div class="stat-label">Attendance Rate</div>
                                <div class="stat-change positive">
                                    <i data-lucide="trending-up"></i>
                                    +2.5%
                                </div>
                            </div>
                        </div>
                        
                        <div class="stat-card">
                            <div class="stat-icon primary">
                                <i data-lucide="book-open"></i>
                            </div>
                            <div class="stat-content">
                                <div class="stat-value">124</div>
                                <div class="stat-label">Total Students</div>
                                <div class="stat-change neutral">
                                    <i data-lucide="users"></i>
                                    5 sections
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Absence Monitor -->
                    <div class="card monitor-card">
                        <div class="card-header">
                            <div class="card-title">
                                <i data-lucide="user-x" class="card-icon"></i>
                                <h2>Absence Monitor</h2>
                            </div>
                        </div>
                        
                        <div class="card-content">
                            <div class="monitor-section">
                                <h3 class="monitor-title">Absent Students</h3>
                                <div class="monitor-list">
                                    <div class="monitor-item">
                                        <div class="monitor-avatar danger">
                                            <i data-lucide="alert-circle"></i>
                                        </div>
                                        <div class="monitor-info">
                                            <span class="monitor-name">Jessica Davis</span>
                                            <span class="monitor-id">ID: 2023004</span>
                                        </div>
                                        <div class="monitor-badge danger">3 absences</div>
                                    </div>
                                    
                                    <div class="monitor-item">
                                        <div class="monitor-avatar danger">
                                            <i data-lucide="alert-circle"></i>
                                        </div>
                                        <div class="monitor-info">
                                            <span class="monitor-name">Ryan Thompson</span>
                                            <span class="monitor-id">ID: 2023008</span>
                                        </div>
                                        <div class="monitor-badge danger">2 absences</div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="monitor-section">
                                <h3 class="monitor-title">Late Students</h3>
                                <div class="monitor-list">
                                    <div class="monitor-item">
                                        <div class="monitor-avatar warning">
                                            <i data-lucide="clock"></i>
                                        </div>
                                        <div class="monitor-info">
                                            <span class="monitor-name">Michael Brown</span>
                                            <span class="monitor-id">ID: 2023003</span>
                                        </div>
                                        <div class="monitor-badge warning">2 late</div>
                                    </div>
                                </div>
                            </div>
                            
                            <button class="btn btn-secondary btn-full">
                                View All Issues
                            </button>
                        </div>
                    </div>

                    <!-- Correction Requests -->
                    <div class="card requests-card">
                        <div class="card-header">
                            <div class="card-title">
                                <i data-lucide="clipboard-check" class="card-icon"></i>
                                <h2>Correction Requests</h2>
                            </div>
                        </div>
                        
                        <div class="card-content">
                            <div class="request-list">
                                <div class="request-item">
                                    <div class="request-header">
                                        <div class="request-info">
                                            <span class="request-name">Emily Johnson</span>
                                            <span class="request-id">ID: 2023002</span>
                                        </div>
                                        <span class="request-status pending">Pending</span>
                                    </div>
                                    <div class="request-details">
                                        <p><strong>Date:</strong> Oct 15, 2023</p>
                                        <p><strong>Reason:</strong> Forgot to sign out</p>
                                    </div>
                                    <div class="request-actions">
                                        <button class="btn btn-sm btn-success">
                                            <i data-lucide="check-circle"></i>
                                            Approve
                                        </button>
                                        <button class="btn btn-sm btn-danger">
                                            <i data-lucide="x-circle"></i>
                                            Reject
                                        </button>
                                    </div>
                                </div>
                                
                                <div class="request-item">
                                    <div class="request-header">
                                        <div class="request-info">
                                            <span class="request-name">Michael Brown</span>
                                            <span class="request-id">ID: 2023003</span>
                                        </div>
                                        <span class="request-status pending">Pending</span>
                                    </div>
                                    <div class="request-details">
                                        <p><strong>Date:</strong> Oct 12, 2023</p>
                                        <p><strong>Reason:</strong> System error during sign-in</p>
                                    </div>
                                    <div class="request-actions">
                                        <button class="btn btn-sm btn-success">
                                            <i data-lucide="check-circle"></i>
                                            Approve
                                        </button>
                                        <button class="btn btn-sm btn-danger">
                                            <i data-lucide="x-circle"></i>
                                            Reject
                                        </button>
                                    </div>
                                </div>
                            </div>
                            
                            <button class="btn btn-secondary btn-full">
                                View All Requests
                            </button>
                        </div>
                    </div>

                    <!-- Upcoming Classes -->
                    <div class="card schedule-card">
                        <div class="card-header">
                            <div class="card-title">
                                <i data-lucide="calendar" class="card-icon"></i>
                                <h2>Upcoming Classes</h2>
                            </div>
                            <div class="calendar-nav">
                                <button class="btn btn-sm btn-ghost" id="prevMonth">
                                    <i data-lucide="chevron-left"></i>
                                </button>
                                <span class="calendar-month" id="currentMonth">October 2023</span>
                                <button class="btn btn-sm btn-ghost" id="nextMonth">
                                    <i data-lucide="chevron-right"></i>
                                </button>
                            </div>
                        </div>
                        
                        <div class="card-content">
                            <div class="schedule-list">
                                <div class="schedule-item">
                                    <div class="schedule-date">
                                        <span class="date-day">16</span>
                                        <span class="date-month">Oct</span>
                                    </div>
                                    <div class="schedule-info">
                                        <span class="schedule-class">CS 101</span>
                                        <span class="schedule-section">Section A</span>
                                        <span class="schedule-time">09:00 - 10:30 AM</span>
                                        <span class="schedule-room">Room 101</span>
                                    </div>
                                </div>
                                
                                <div class="schedule-item">
                                    <div class="schedule-date">
                                        <span class="date-day">17</span>
                                        <span class="date-month">Oct</span>
                                    </div>
                                    <div class="schedule-info">
                                        <span class="schedule-class">CS 202</span>
                                        <span class="schedule-section">Section B</span>
                                        <span class="schedule-time">11:00 - 12:30 PM</span>
                                        <span class="schedule-room">Lab 3</span>
                                    </div>
                                </div>
                                
                                <div class="schedule-item">
                                    <div class="schedule-date">
                                        <span class="date-day">18</span>
                                        <span class="date-month">Oct</span>
                                    </div>
                                    <div class="schedule-info">
                                        <span class="schedule-class">CS 305</span>
                                        <span class="schedule-section">Section C</span>
                                        <span class="schedule-time">02:00 - 03:30 PM</span>
                                        <span class="schedule-room">Lecture Hall B</span>
                                    </div>
                                </div>
                            </div>
                            
                            <button class="btn btn-secondary btn-full">
                                View Full Schedule
                            </button>
                        </div>
                    </div>

                    <!-- Class Reschedule -->
                    <div class="card reschedule-card">
                        <div class="card-header">
                            <div class="card-title">
                                <i data-lucide="calendar-plus" class="card-icon"></i>
                                <h2>Request Reschedule</h2>
                            </div>
                        </div>
                        
                        <div class="card-content">
                            <form class="reschedule-form">
                                <div class="form-group">
                                    <label class="form-label">Class</label>
                                    <select class="form-select">
                                        <option>CS 101 - Introduction to Programming</option>
                                        <option>CS 202 - Data Structures</option>
                                        <option>CS 305 - Algorithm Design</option>
                                    </select>
                                </div>
                                
                                <div class="form-group">
                                    <label class="form-label">Original Date</label>
                                    <input type="date" class="form-input">
                                </div>
                                
                                <div class="form-group">
                                    <label class="form-label">Proposed New Date</label>
                                    <input type="date" class="form-input">
                                </div>
                                
                                <div class="form-group">
                                    <label class="form-label">Reason</label>
                                    <textarea class="form-textarea" rows="3" placeholder="Explain the reason for rescheduling..."></textarea>
                                </div>
                                
                                <button type="submit" class="btn btn-primary btn-full">
                                    Submit Request
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-section">
                    <div class="footer-logo">
                        <span class="logo-primary">CICS</span>
                        <span class="logo-secondary">Attendance</span>
                    </div>
                    <p class="footer-description">
                        A comprehensive attendance management system for instructors to track student attendance efficiently.
                    </p>
                </div>
                
                <div class="footer-section">
                    <h3 class="footer-title">Quick Links</h3>
                    <ul class="footer-links">
                        <li><a href="#">Help Center</a></li>
                        <li><a href="#">Privacy Policy</a></li>
                        <li><a href="#">Terms of Service</a></li>
                    </ul>
                </div>
                
                <div class="footer-section">
                    <h3 class="footer-title">Contact</h3>
                    <ul class="footer-contact">
                        <li>Email: support@cics.edu</li>
                        <li>Phone: (555) 123-4567</li>
                        <li>Hours: Mon-Fri 8:00 AM - 5:00 PM</li>
                    </ul>
                </div>
            </div>
            
            <div class="footer-bottom">
                <p>&copy; <span id="currentYear">2023</span> CICS Attendance Management System. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/lucide/1.0.0/lucide.min.js"></script>
    <script src="sidebar.js"></script>
    <script src="intructor.js"></script>
</body>
</html>