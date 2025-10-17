<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Classes Management - CICS Attendance System</title>
    <link rel="stylesheet" href="Classes.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/lucide/1.0.0/lucide.min.css" rel="stylesheet">
</head>
<body>
    <div class="classes-page">
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
                    <a href="Classes.php" class="nav-link active">
                        <i data-lucide="book-open" class="nav-icon"></i>
                        <span>Classes</span>
                    </a>
                </div>
                <div class="nav-item">
                    <a href="student.php" class="nav-link">
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
                
                <div class="sidebar-sep"></div>
                
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
                
                <div class="sidebar-sep"></div>
                
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
        <header class="app-header">
            <div class="container">
                <div style="display: flex; align-items: center; justify-content: space-between; padding: 1rem 0;">
                    <div style="display: flex; align-items: center; gap: 1rem;">
                        <button id="mobileMenuBtn" style="display: none; background: none; border: none; color: var(--primary-navy); cursor: pointer;">
                            <i data-lucide="menu" style="width: 1.5rem; height: 1.5rem;"></i>
                        </button>
                        <div>
                            <h1 style="margin: 0; color: var(--primary-navy); font-family: 'Poppins', sans-serif; font-size: 1.875rem; font-weight: 700;">
                                <span style="color: var(--accent-gold);">CICS</span> CLASSES
                            </h1>
                            <p style="margin: 0; color: var(--text-medium); font-size: 0.875rem;">Manage class schedules and attendance sessions</p>
                        </div>
                    </div>
                    <div style="display: flex; align-items: center; gap: 1rem;">
                        <button style="position: relative; background: none; border: none; color: var(--text-medium); cursor: pointer; padding: 0.5rem; border-radius: 0.5rem; transition: all 0.2s ease;">
                            <i data-lucide="bell" style="width: 1.25rem; height: 1.25rem;"></i>
                            <span style="position: absolute; top: 0.25rem; right: 0.25rem; background: var(--error); color: white; border-radius: 50%; width: 1rem; height: 1rem; font-size: 0.75rem; display: flex; align-items: center; justify-content: center;">2</span>
                        </button>
                        <button style="background: none; border: none; color: var(--text-medium); cursor: pointer; padding: 0.5rem; border-radius: 0.5rem; transition: all 0.2s ease;">
                            <i data-lucide="calendar" style="width: 1.25rem; height: 1.25rem;"></i>
                        </button>
                        <div style="display: flex; align-items: center; gap: 0.75rem;">
                            <div style="width: 2.5rem; height: 2.5rem; border-radius: 50%; background: var(--accent-gold); display: flex; align-items: center; justify-content: center; color: var(--primary-navy); font-weight: 600;">
                                PS
                            </div>
                            <div>
                                <span style="font-weight: 500; color: var(--text-dark); display: block;">Prof. Smith</span>
                                <span style="color: var(--text-medium); font-size: 0.875rem;">Instructor</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <!-- Hero Section -->
        <section class="hero-section animate-fadeInUp">
            <div class="container">
                <div class="hero-content">
                    <div class="hero-text">
                        <h1 class="hero-title">Class Management</h1>
                        <p class="hero-subtitle">Manage attendance sessions, schedules, and track class performance efficiently</p>
                        <div class="page-actions">
                            <button class="btn btn-primary btn-lg">
                                <i data-lucide="play"></i>
                                Start Session
                            </button>
                            <button class="btn btn-secondary btn-lg">
                                <i data-lucide="calendar"></i>
                                View Schedule
                            </button>
                        </div>
                    </div>
                    <div class="hero-image">
                        <div class="hero-icon">
                            <i data-lucide="book-open"></i>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <main class="with-sidebar">
            <div class="container">
                <!-- Statistics Cards -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8 animate-fadeInUp">
                    <div class="stat-card">
                        <div class="stat-value">18</div>
                        <div class="stat-label">Active Classes</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-value">124</div>
                        <div class="stat-label">Total Students</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-value">92%</div>
                        <div class="stat-label">Attendance Rate</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-value">3</div>
                        <div class="stat-label">Pending Requests</div>
                    </div>
                </div>

                <section class="grid grid-cols-1 md:grid-cols-2 gap-8 animate-fadeInUp">
                    <div class="card feature-card p-8">
                        <h2 class="card-title">Start / End Attendance Session</h2>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                            <div>
                                <label class="form-label">Class</label>
                                <select class="input">
                                    <option>CS 101 - Introduction to Programming</option>
                                    <option>CS 202 - Data Structures</option>
                                    <option>CS 305 - Algorithm Design</option>
                                </select>
                            </div>
                            <div>
                                <label class="form-label">Section</label>
                                <select class="input">
                                    <option>A - Morning</option>
                                    <option>B - Afternoon</option>
                                    <option>C - Evening</option>
                                </select>
                            </div>
                            <div>
                                <label class="form-label">Room</label>
                                <select class="input">
                                    <option>Room 101</option>
                                    <option>Lab 3</option>
                                    <option>Lecture Hall B</option>
                                </select>
                            </div>
                        </div>
                        <div class="session-banner hidden" id="clsSessionBanner">
                            <div>
                                <p class="font-bold" style="color: var(--primary-navy);">Session in progress</p>
                                <p class="text-sm" style="color: var(--text-medium);">Started at: <span id="clsStartTime">--:--</span></p>
                            </div>
                            <div class="text-2xl font-bold" style="color: var(--primary-navy);" id="clsTimer">00:00:00</div>
                        </div>
                        <div class="flex space-x-2 mt-4">
                            <button class="btn btn-primary flex-1" id="clsStart">
                                <i data-lucide="play"></i>
                                <span>Start Session</span>
                            </button>
                            <button class="btn btn-reject flex-1 hidden" id="clsEnd">
                                <i data-lucide="stop-circle"></i>
                                <span>End Session</span>
                            </button>
                        </div>
                    </div>

                    <div class="card feature-card p-8">
                        <h2 class="card-title">Upcoming Class Schedules</h2>
                        <div class="space-y-3">
                            <div class="schedule-item">
                                <div>
                                    <p style="color: var(--primary-navy); font-weight: 600;">CS 101 • Section A</p>
                                    <p style="color: var(--text-medium); font-size: 0.875rem;">09:00 - 10:30 AM • Room 101</p>
                                </div>
                                <div class="date-chip">16 Oct</div>
                            </div>
                            <div class="schedule-item">
                                <div>
                                    <p style="color: var(--primary-navy); font-weight: 600;">CS 202 • Section B</p>
                                    <p style="color: var(--text-medium); font-size: 0.875rem;">11:00 - 12:30 PM • Lab 3</p>
                                </div>
                                <div class="date-chip">17 Oct</div>
                            </div>
                            <div class="schedule-item">
                                <div>
                                    <p style="color: var(--primary-navy); font-weight: 600;">CS 305 • Section C</p>
                                    <p style="color: var(--text-medium); font-size: 0.875rem;">02:00 - 03:30 PM • Lecture Hall B</p>
                                </div>
                                <div class="date-chip">18 Oct</div>
                            </div>
                        </div>
                        <button class="btn btn-secondary w-full mt-4">
                            <i data-lucide="calendar"></i>
                            View Full Schedule
                        </button>
                    </div>
                </section>

            <section class="grid grid-cols-1 lg:grid-cols-3 gap-8 mt-8 animate-fadeInUp">
                <div class="lg:col-span-2 card p-8">
                    <div class="flex items-center justify-between mb-4">
                        <h2 class="card-title">Attendance Logs</h2>
                        <div class="flex space-x-2">
                            <button class="btn btn-secondary">
                                <i data-lucide="filter"></i>
                                <span>Filter</span>
                            </button>
                            <button class="btn btn-secondary">
                                <i data-lucide="printer"></i>
                                <span>Print</span>
                            </button>
                            <button class="btn btn-primary">
                                <i data-lucide="download"></i>
                                <span>Export</span>
                            </button>
                        </div>
                    </div>
                    <div class="table-container">
                        <table class="data-table">
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
                                    <td style="font-weight: 500; color: var(--text-dark);">John Smith</td>
                                    <td style="color: var(--text-medium);">2023001</td>
                                    <td style="color: var(--text-medium);">09:15 AM</td>
                                    <td style="color: var(--text-medium);">10:45 AM</td>
                                    <td><span class="status-chip success">Present</span></td>
                                </tr>
                                <tr>
                                    <td style="font-weight: 500; color: var(--text-dark);">Emily Johnson</td>
                                    <td style="color: var(--text-medium);">2023002</td>
                                    <td style="color: var(--text-medium);">09:10 AM</td>
                                    <td style="color: var(--text-medium);">10:45 AM</td>
                                    <td><span class="status-chip warning">Late</span></td>
                                </tr>
                                <tr>
                                    <td style="font-weight: 500; color: var(--text-dark);">Jessica Davis</td>
                                    <td style="color: var(--text-medium);">2023004</td>
                                    <td style="color: var(--text-medium);">-</td>
                                    <td style="color: var(--text-medium);">-</td>
                                    <td><span class="status-chip danger">Absent</span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="space-y-8">
                    <div class="card feature-card p-8">
                        <h2 class="card-title">Correction Requests</h2>
                        <div class="space-y-4">
                            <div style="border: 1px solid var(--border-light); border-radius: 0.5rem; padding: 1rem;">
                                <div class="flex justify-between items-start mb-2">
                                    <div>
                                        <p style="font-weight: 500; color: var(--text-dark); font-size: 0.875rem;">Michael Brown</p>
                                        <p style="color: var(--text-medium); font-size: 0.75rem;">ID: 2023003</p>
                                    </div>
                                    <span style="background: rgba(245, 158, 11, 0.1); color: #f59e0b; padding: 0.25rem 0.75rem; border-radius: 9999px; font-size: 0.75rem; font-weight: 500;">Pending</span>
                                </div>
                                <p style="color: var(--text-medium); font-size: 0.75rem; margin-bottom: 0.5rem;"><span style="font-weight: 500;">Date:</span> Oct 12, 2023</p>
                                <p style="color: var(--text-medium); font-size: 0.75rem; margin-bottom: 0.75rem;"><span style="font-weight: 500;">Reason:</span> Missed Time-In</p>
                                <div class="flex space-x-2">
                                    <button class="btn btn-approve flex-1">
                                        <i data-lucide="check-circle"></i>
                                        <span>Approve</span>
                                    </button>
                                    <button class="btn btn-reject flex-1">
                                        <i data-lucide="x-circle"></i>
                                        <span>Reject</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-secondary w-full mt-4">
                            <i data-lucide="clipboard-check"></i>
                            View All Requests
                        </button>
                    </div>

                    <div class="card feature-card p-8">
                        <h2 class="card-title">Request Class Reschedule</h2>
                        <form class="space-y-3">
                            <div>
                                <label class="form-label">Class</label>
                                <select class="input">
                                    <option>CS 101 - Introduction to Programming</option>
                                    <option>CS 202 - Data Structures</option>
                                    <option>CS 305 - Algorithm Design</option>
                                </select>
                            </div>
                            <div>
                                <label class="form-label">Original Date</label>
                                <input type="date" class="input" />
                            </div>
                            <div>
                                <label class="form-label">Proposed New Date</label>
                                <input type="date" class="input" />
                            </div>
                            <div>
                                <label class="form-label">Reason</label>
                                <textarea class="input" rows="3" placeholder="Explain the reason for rescheduling..."></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary w-full">
                                <i data-lucide="send"></i>
                                Submit Request
                            </button>
                        </form>
                    </div>
                </div>
            </section>

            <section class="grid grid-cols-1 md:grid-cols-2 gap-8 mt-8 animate-fadeInUp">
                <div class="card p-8">
                    <h2 class="card-title">Absences & Lateness Monitor</h2>
                    <div class="space-y-4">
                        <div class="flex items-center justify-between py-3" style="border-bottom: 1px solid var(--border-light);">
                            <div class="flex items-center">
                                <div style="width: 2rem; height: 2rem; border-radius: 50%; background: rgba(239, 68, 68, 0.1); display: flex; align-items: center; justify-content: center; color: var(--error); margin-right: 0.75rem;">
                                    <i data-lucide="alert-circle" style="width: 1rem; height: 1rem;"></i>
                                </div>
                                <div>
                                    <p style="font-weight: 500; color: var(--text-dark); font-size: 0.875rem;">Jessica Davis</p>
                                    <p style="color: var(--text-medium); font-size: 0.75rem;">ID: 2023004</p>
                                </div>
                            </div>
                            <div class="status-chip danger">3 absences</div>
                        </div>
                        <div class="flex items-center justify-between py-3" style="border-bottom: 1px solid var(--border-light);">
                            <div class="flex items-center">
                                <div style="width: 2rem; height: 2rem; border-radius: 50%; background: rgba(245, 158, 11, 0.1); display: flex; align-items: center; justify-content: center; color: #f59e0b; margin-right: 0.75rem;">
                                    <i data-lucide="clock" style="width: 1rem; height: 1rem;"></i>
                                </div>
                                <div>
                                    <p style="font-weight: 500; color: var(--text-dark); font-size: 0.875rem;">Ryan Thompson</p>
                                    <p style="color: var(--text-medium); font-size: 0.75rem;">ID: 2023008</p>
                                </div>
                            </div>
                            <div class="status-chip warning">2 late</div>
                        </div>
                    </div>
                    <button class="btn btn-secondary w-full mt-4">
                        <i data-lucide="users"></i>
                        View All Issues
                    </button>
                </div>

                <div class="card p-8">
                    <h2 class="card-title">Class Statistics</h2>
                    <div class="grid grid-cols-2 gap-4 mb-6">
                        <div style="background: var(--soft-blue); border-radius: 0.5rem; padding: 1rem; text-align: center;">
                            <p style="color: var(--text-medium); font-size: 0.75rem; margin-bottom: 0.5rem;">Attendance Rate</p>
                            <p style="font-size: 2rem; font-weight: 700; color: var(--primary-navy); font-family: 'Poppins', sans-serif;">92%</p>
                        </div>
                        <div style="background: var(--soft-blue); border-radius: 0.5rem; padding: 1rem; text-align: center;">
                            <p style="color: var(--text-medium); font-size: 0.75rem; margin-bottom: 0.5rem;">Avg. Lateness</p>
                            <p style="font-size: 2rem; font-weight: 700; color: var(--primary-navy); font-family: 'Poppins', sans-serif;">6m</p>
                        </div>
                    </div>
                    <div class="chart-placeholder">Performance trends chart will be displayed here</div>
                </div>
            </section>
            </div>
        </main>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/lucide/1.0.0/lucide.min.js"></script>
    <script>
        // Initialize Lucide icons
        lucide.createIcons();

        // Sidebar functionality
        const sidebar = document.getElementById('sidebar');
        const sidebarOverlay = document.getElementById('sidebarOverlay');
        const mobileMenuBtn = document.getElementById('mobileMenuBtn');

        if (mobileMenuBtn) {
            mobileMenuBtn.addEventListener('click', () => {
                sidebar.classList.toggle('open');
                sidebarOverlay.classList.toggle('active');
            });
        }

        if (sidebarOverlay) {
            sidebarOverlay.addEventListener('click', () => {
                sidebar.classList.remove('open');
                sidebarOverlay.classList.remove('active');
            });
        }

        // Handle window resize
        window.addEventListener('resize', () => {
            if (window.innerWidth >= 768) {
                sidebar.classList.remove('open');
                sidebarOverlay.classList.remove('active');
            }
        });

        // Session timer functionality
        const startBtn = document.getElementById('clsStart');
        const endBtn = document.getElementById('clsEnd');
        const banner = document.getElementById('clsSessionBanner');
        const timerEl = document.getElementById('clsTimer');
        const startTimeEl = document.getElementById('clsStartTime');
        let sec = 0;
        let interval;

        function fmt(n) {
            return n.toString().padStart(2, '0');
        }

        function tick() {
            sec++;
            const h = Math.floor(sec / 3600);
            const m = Math.floor((sec % 3600) / 60);
            const s = sec % 60;
            timerEl.textContent = `${fmt(h)}:${fmt(m)}:${fmt(s)}`;
        }

        if (startBtn) {
            startBtn.addEventListener('click', () => {
                startBtn.classList.add('hidden');
                endBtn.classList.remove('hidden');
                banner.classList.remove('hidden');
                sec = 0;
                tick();
                interval = setInterval(tick, 1000);
                const now = new Date();
                const hh = now.getHours() % 12 || 12;
                const mm = fmt(now.getMinutes());
                const ap = now.getHours() >= 12 ? 'PM' : 'AM';
                startTimeEl.textContent = `${hh}:${mm} ${ap}`;
            });
        }

        if (endBtn) {
            endBtn.addEventListener('click', () => {
                endBtn.classList.add('hidden');
                startBtn.classList.remove('hidden');
                banner.classList.add('hidden');
                clearInterval(interval);
            });
        }

        // Navigation active states
        document.querySelectorAll('.sidebar-nav .nav-link').forEach(link => {
            link.addEventListener('click', (e) => {
                document.querySelectorAll('.sidebar-nav .nav-link').forEach(l => l.classList.remove('active'));
                e.currentTarget.classList.add('active');
            });
        });

        // Initialize page
        document.addEventListener('DOMContentLoaded', () => {
            lucide.createIcons();
        });
    </script>
</body>
</html>

