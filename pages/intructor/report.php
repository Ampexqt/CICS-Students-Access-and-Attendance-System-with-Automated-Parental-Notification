<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reports & Analytics - CICS Attendance System</title>
    <link rel="stylesheet" href="shared-sidebar.css">
    <link rel="stylesheet" href="report.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/lucide/1.0.0/lucide.min.css" rel="stylesheet">
</head>
<body>
    <div class="reports-page">
        <?php include 'sidebar-include.php'; ?>

        <!-- Header -->
        <header class="app-header">
            <div class="container">
                <div style="display: flex; align-items: center; justify-content: space-between; padding: 1rem 0;">
                    <div style="display: flex; align-items: center; gap: 1rem;">
                        <button class="mobile-menu-btn" id="mobileMenuBtn" aria-label="Toggle navigation menu" aria-expanded="false" aria-controls="sidebar">
                            <i data-lucide="menu" aria-hidden="true"></i>
                        </button>
                        <div>
                            <h2 style="margin: 0; color: var(--primary-navy); font-family: 'Poppins', sans-serif;">Reports & Analytics</h2>
                            <p style="margin: 0; color: var(--text-medium); font-size: 0.875rem;">Comprehensive attendance insights and data export</p>
                        </div>
                    </div>
                    <div style="display: flex; align-items: center; gap: 1rem;">
                        <button class="btn btn-secondary btn-sm">
                            <i data-lucide="download"></i>
                            Export All
                        </button>
                        <div style="display: flex; align-items: center; gap: 0.75rem;">
                            <div style="width: 2.5rem; height: 2.5rem; border-radius: 50%; background: var(--accent-gold); display: flex; align-items: center; justify-content: center; color: var(--primary-navy); font-weight: 600;">PS</div>
                            <div>
                                <span style="font-weight: 500; color: var(--text-dark);">Prof. Smith</span>
                                <span style="color: var(--text-medium); font-size: 0.875rem; display: block;">Instructor</span>
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
                        <h1 class="hero-title">Reports & Analytics</h1>
                        <p class="hero-subtitle">Generate comprehensive attendance reports, track performance trends, and export data for analysis</p>
                        <div style="display: flex; gap: 1rem; flex-wrap: wrap;">
                            <button class="btn btn-primary btn-lg">
                                <i data-lucide="file-text"></i>
                                Generate Report
                            </button>
                            <button class="btn btn-gold btn-lg">
                                <i data-lucide="trending-up"></i>
                                View Analytics
                            </button>
                        </div>
                    </div>
                    <div class="hero-image">
                        <div class="hero-icon">
                            <i data-lucide="bar-chart-3"></i>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <main class="with-sidebar">
            <div class="container">
                <!-- Statistics Overview -->
                <div class="stats-grid animate-fadeInUp">
                    <div class="stat-card">
                        <div class="stat-value">1,247</div>
                        <div class="stat-label">Total Records</div>
                        <div class="stat-change positive">
                            <i data-lucide="trending-up" style="width: 0.75rem; height: 0.75rem;"></i>
                            +12% this month
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-value">94.2%</div>
                        <div class="stat-label">Avg Attendance</div>
                        <div class="stat-change positive">
                            <i data-lucide="trending-up" style="width: 0.75rem; height: 0.75rem;"></i>
                            +2.1% vs last month
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-value">18</div>
                        <div class="stat-label">Active Classes</div>
                        <div class="stat-change">
                            <i data-lucide="minus" style="width: 0.75rem; height: 0.75rem;"></i>
                            No change
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-value">127</div>
                        <div class="stat-label">Reports Generated</div>
                        <div class="stat-change positive">
                            <i data-lucide="trending-up" style="width: 0.75rem; height: 0.75rem;"></i>
                            +8 this week
                        </div>
                    </div>
                </div>

                <!-- Filter Section -->
                <div class="filter-section animate-fadeInUp">
                    <h3 style="margin-bottom: 1rem; color: var(--primary-navy);">
                        <i data-lucide="filter" class="card-icon"></i>
                        Report Filters
                    </h3>
                    <div class="filter-row">
                        <div class="filter-group">
                            <label class="form-label">Date Range</label>
                            <select class="form-select">
                                <option>Last 7 days</option>
                                <option>Last 30 days</option>
                                <option>This semester</option>
                                <option>Custom range</option>
                            </select>
                        </div>
                        <div class="filter-group">
                            <label class="form-label">Class/Subject</label>
                            <select class="form-select">
                                <option>All Classes</option>
                                <option>CS 101 - Introduction to Programming</option>
                                <option>CS 202 - Data Structures</option>
                                <option>CS 305 - Algorithm Design</option>
                            </select>
                        </div>
                        <div class="filter-group">
                            <label class="form-label">Section</label>
                            <select class="form-select">
                                <option>All Sections</option>
                                <option>Section A - Morning</option>
                                <option>Section B - Afternoon</option>
                                <option>Section C - Evening</option>
                            </select>
                        </div>
                        <div class="filter-group">
                            <label class="form-label">&nbsp;</label>
                            <button class="btn btn-primary w-full">
                                <i data-lucide="search"></i>
                                Apply Filters
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Report Generation Cards -->
                <div class="grid grid-3 animate-fadeInUp">
                    <div class="card feature-card">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i data-lucide="users" class="card-icon"></i>
                                Attendance Reports
                            </h3>
                        </div>
                        <div class="card-content">
                            <p style="color: var(--text-medium); margin-bottom: 1.5rem;">Generate detailed attendance reports by class, section, or individual student performance.</p>
                            <div class="card-actions">
                                <button class="btn btn-primary">
                                    <i data-lucide="file-text"></i>
                                    Class Report
                                </button>
                                <button class="btn btn-secondary">
                                    <i data-lucide="user"></i>
                                    Student Report
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="card feature-card">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i data-lucide="alert-triangle" class="card-icon"></i>
                                Absence & Lateness
                            </h3>
                        </div>
                        <div class="card-content">
                            <p style="color: var(--text-medium); margin-bottom: 1.5rem;">Monitor students with frequent absences or tardiness patterns for intervention.</p>
                            <div class="card-actions">
                                <button class="btn btn-primary">
                                    <i data-lucide="alert-circle"></i>
                                    Absence Report
                                </button>
                                <button class="btn btn-secondary">
                                    <i data-lucide="clock"></i>
                                    Lateness Report
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="card feature-card">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i data-lucide="trending-up" class="card-icon"></i>
                                Performance Analytics
                            </h3>
                        </div>
                        <div class="card-content">
                            <p style="color: var(--text-medium); margin-bottom: 1.5rem;">Analyze attendance trends, patterns, and statistical insights across all classes.</p>
                            <div class="card-actions">
                                <button class="btn btn-primary">
                                    <i data-lucide="bar-chart"></i>
                                    Trend Analysis
                                </button>
                                <button class="btn btn-secondary">
                                    <i data-lucide="pie-chart"></i>
                                    Statistics
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Charts and Analytics -->
                <div class="grid grid-2 animate-fadeInUp">
                    <div class="chart-container">
                        <h3 class="card-title mb-4">
                            <i data-lucide="trending-up" class="card-icon"></i>
                            Attendance Trends (Last 30 Days)
                        </h3>
                        <div class="chart-placeholder">
                            Interactive attendance trend chart will be displayed here
                            <br><small>Shows daily attendance rates across all classes</small>
                        </div>
                    </div>

                    <div class="chart-container">
                        <h3 class="card-title mb-4">
                            <i data-lucide="pie-chart" class="card-icon"></i>
                            Class Performance Distribution
                        </h3>
                        <div class="chart-placeholder">
                            Pie chart showing attendance distribution by class
                            <br><small>Breakdown of attendance rates per subject</small>
                        </div>
                    </div>
                </div>

                <!-- Recent Reports Table -->
                <div class="card animate-fadeInUp">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i data-lucide="file-text" class="card-icon"></i>
                            Recent Reports
                        </h3>
                        <div class="card-actions">
                            <button class="btn btn-secondary btn-sm">
                                <i data-lucide="refresh-cw"></i>
                                Refresh
                            </button>
                            <button class="btn btn-primary btn-sm">
                                <i data-lucide="plus"></i>
                                New Report
                            </button>
                        </div>
                    </div>
                    <div class="table-container">
                        <table class="data-table">
                            <thead>
                                <tr>
                                    <th>Report Name</th>
                                    <th>Type</th>
                                    <th>Date Generated</th>
                                    <th>Records</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td style="font-weight: 500;">CS 101 Monthly Attendance</td>
                                    <td>Class Report</td>
                                    <td>Oct 15, 2024</td>
                                    <td>156 records</td>
                                    <td><span class="status-badge status-present">Complete</span></td>
                                    <td>
                                        <div style="display: flex; gap: 0.5rem;">
                                            <button class="btn btn-secondary btn-sm">
                                                <i data-lucide="download"></i>
                                            </button>
                                            <button class="btn btn-secondary btn-sm">
                                                <i data-lucide="eye"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="font-weight: 500;">Absence Alert Report</td>
                                    <td>Alert Report</td>
                                    <td>Oct 14, 2024</td>
                                    <td>23 records</td>
                                    <td><span class="status-badge status-late">Processing</span></td>
                                    <td>
                                        <div style="display: flex; gap: 0.5rem;">
                                            <button class="btn btn-secondary btn-sm" disabled>
                                                <i data-lucide="download"></i>
                                            </button>
                                            <button class="btn btn-secondary btn-sm">
                                                <i data-lucide="eye"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="font-weight: 500;">Weekly Performance Summary</td>
                                    <td>Analytics</td>
                                    <td>Oct 13, 2024</td>
                                    <td>342 records</td>
                                    <td><span class="status-badge status-present">Complete</span></td>
                                    <td>
                                        <div style="display: flex; gap: 0.5rem;">
                                            <button class="btn btn-secondary btn-sm">
                                                <i data-lucide="download"></i>
                                            </button>
                                            <button class="btn btn-secondary btn-sm">
                                                <i data-lucide="eye"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Export and Print Options -->
                <div class="grid grid-2 animate-fadeInUp">
                    <div class="card feature-card">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i data-lucide="download" class="card-icon"></i>
                                Export Options
                            </h3>
                        </div>
                        <div class="card-content">
                            <p style="color: var(--text-medium); margin-bottom: 1.5rem;">Export attendance data in various formats for external analysis or record keeping.</p>
                            <div class="card-actions">
                                <button class="btn btn-primary">
                                    <i data-lucide="file-spreadsheet"></i>
                                    Excel Export
                                </button>
                                <button class="btn btn-secondary">
                                    <i data-lucide="file-text"></i>
                                    PDF Report
                                </button>
                                <button class="btn btn-secondary">
                                    <i data-lucide="database"></i>
                                    CSV Data
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="card feature-card">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i data-lucide="settings" class="card-icon"></i>
                                Report Settings
                            </h3>
                        </div>
                        <div class="card-content">
                            <p style="color: var(--text-medium); margin-bottom: 1.5rem;">Configure automatic report generation, email notifications, and custom templates.</p>
                            <div class="card-actions">
                                <button class="btn btn-primary">
                                    <i data-lucide="clock"></i>
                                    Schedule Reports
                                </button>
                                <button class="btn btn-secondary">
                                    <i data-lucide="mail"></i>
                                    Email Settings
                                </button>
                                <button class="btn btn-secondary">
                                    <i data-lucide="layout"></i>
                                    Templates
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="card feature-card animate-fadeInUp">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i data-lucide="zap" class="card-icon"></i>
                            Quick Actions
                        </h3>
                    </div>
                    <div class="card-content">
                        <div class="grid grid-4">
                            <button class="btn btn-secondary w-full">
                                <i data-lucide="calendar"></i>
                                Today's Summary
                            </button>
                            <button class="btn btn-secondary w-full">
                                <i data-lucide="alert-triangle"></i>
                                Absence Alerts
                            </button>
                            <button class="btn btn-secondary w-full">
                                <i data-lucide="users"></i>
                                Class Overview
                            </button>
                            <button class="btn btn-secondary w-full">
                                <i data-lucide="printer"></i>
                                Print Reports
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/lucide/1.0.0/lucide.min.js"></script>
    <script src="sidebar.js"></script>
    <script>
        // Sidebar functionality is now handled by sidebar.js

        // Navigation is now handled by sidebar.js

        // Report generation simulation
        document.querySelectorAll('.btn').forEach(btn => {
            if (btn.textContent.includes('Report') || btn.textContent.includes('Export')) {
                btn.addEventListener('click', (e) => {
                    const originalText = btn.innerHTML;
                    btn.innerHTML = '<i data-lucide="loader-2" style="animation: spin 1s linear infinite;"></i> Processing...';
                    btn.disabled = true;
                    
                    setTimeout(() => {
                        btn.innerHTML = originalText;
                        btn.disabled = false;
                        lucide.createIcons();
                        
                        // Show success message (you can replace with actual notification system)
                        const notification = document.createElement('div');
                        notification.style.cssText = `
                            position: fixed;
                            top: 20px;
                            right: 20px;
                            background: var(--success);
                            color: white;
                            padding: 1rem 1.5rem;
                            border-radius: 0.5rem;
                            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
                            z-index: 1000;
                            animation: slideInRight 0.3s ease;
                        `;
                        notification.textContent = 'Report generated successfully!';
                        document.body.appendChild(notification);
                        
                        setTimeout(() => {
                            notification.remove();
                        }, 3000);
                    }, 2000);
                });
            }
        });

        // Initialize page
        document.addEventListener('DOMContentLoaded', () => {
            if (typeof lucide !== 'undefined') {
                lucide.createIcons();
            }
        });

        // Add CSS animation for notifications
        const style = document.createElement('style');
        style.textContent = `
            @keyframes slideInRight {
                from {
                    transform: translateX(100%);
                    opacity: 0;
                }
                to {
                    transform: translateX(0);
                    opacity: 1;
                }
            }
            @keyframes spin {
                from { transform: rotate(0deg); }
                to { transform: rotate(360deg); }
            }
        `;
        document.head.appendChild(style);
    </script>
</body>
</html>