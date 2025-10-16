// Router
const app = {
  routes: {},
  currentPage: null,
  
  init() {
    this.setupRoutes();
    this.setupNavigation();
    window.addEventListener('hashchange', () => this.handleRoute());
    this.handleRoute();
  },
  
  setupRoutes() {
    this.routes = {
      '/': pages.dashboard,
      '/instructors': pages.instructors,
      '/students': pages.students,
      '/requests/correction': pages.correctionRequests,
      '/requests/device': pages.deviceRequests,
      '/requests/password': pages.passwordRequests,
      '/requests/reschedule': pages.rescheduleRequests,
      '/reports': pages.reports,
      '/gps': pages.gps,
      '/settings': pages.settings
    };
  },
  
  setupNavigation() {
    document.getElementById('requests-toggle').addEventListener('click', (e) => {
      e.preventDefault();
      const submenu = document.getElementById('requests-submenu');
      submenu.classList.toggle('open');
    });
  },
  
  handleRoute() {
    const hash = window.location.hash.slice(1) || '/';
    const route = this.routes[hash] || this.routes['/'];
    
    // Update active nav links
    document.querySelectorAll('.nav-link').forEach(link => {
      link.classList.remove('active');
      // Only highlight the exact route; don't also highlight the parent
      if (link.dataset.route === hash) {
        link.classList.add('active');
      }
    });
    
    // Show/hide requests submenu
    if (hash.includes('/requests')) {
      document.getElementById('requests-submenu').classList.add('open');
    }
    
    // Update page title
    const titles = {
      '/': 'Dashboard',
      '/instructors': 'Manage Instructors',
      '/students': 'Manage Students',
      '/requests/correction': 'Correction Requests',
      '/requests/device': 'Device Change Requests',
      '/requests/password': 'Password Change Requests',
      '/requests/reschedule': 'Reschedule Requests',
      '/reports': 'Attendance Reports',
      '/gps': 'GPS Settings',
      '/settings': 'Account Settings'
    };
    document.getElementById('page-title').textContent = titles[hash] || 'Dashboard';
    
    // Render page
    route();
  }
};

// Chart instances storage
const chartInstances = {};

// Pages
const pages = {
  dashboard() {
    document.getElementById('app').innerHTML = `
      <div class="grid grid-cols-4">
        <div class="stat-card">
          <div class="stat-card-content">
            <p>Total Instructors</p>
            <h3>42</h3>
          </div>
          <div class="stat-card-icon primary">
            <svg width="20" height="20" fill="white" viewBox="0 0 24 24">
              <path d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
            </svg>
          </div>
        </div>
        <div class="stat-card">
          <div class="stat-card-content">
            <p>Total Students</p>
            <h3>1,284</h3>
          </div>
          <div class="stat-card-icon secondary">
            <svg width="20" height="20" fill="white" viewBox="0 0 24 24">
              <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
          </div>
        </div>
        <div class="stat-card">
          <div class="stat-card-content">
            <p>Attendance Rate (Today)</p>
            <h3>85%</h3>
          </div>
          <div class="stat-card-icon accent">
            <svg width="20" height="20" fill="#1a3e6c" viewBox="0 0 24 24">
              <path d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
            </svg>
          </div>
        </div>
        <div class="stat-card">
          <div class="stat-card-content">
            <p>Pending Requests</p>
            <h3>18</h3>
          </div>
          <div class="stat-card-icon primary">
            <svg width="20" height="20" fill="white" viewBox="0 0 24 24">
              <path d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
            </svg>
          </div>
        </div>
      </div>
      <div style="margin-top: 24px;" class="grid grid-cols-2">
        <div class="card">
          <h3 style="font-weight: 600; margin-bottom: 16px;">Attendance Rate by Course</h3>
          <div style="height: 250px;">
            <canvas id="courseAttendanceChart"></canvas>
          </div>
        </div>
        <div class="card">
          <h3 style="font-weight: 600; margin-bottom: 16px;">Weekly Attendance Trend</h3>
          <div style="height: 250px;">
            <canvas id="weeklyTrendChart"></canvas>
          </div>
        </div>
      </div>
      <div style="margin-top: 24px;" class="grid grid-cols-2">
        <div class="card">
          <h3 style="font-weight: 600; margin-bottom: 16px;">Daily Attendance Distribution</h3>
          <div style="height: 300px;">
            <canvas id="dailyAttendanceChart"></canvas>
          </div>
        </div>
        <div class="card">
          <h3 style="font-weight: 600; margin-bottom: 16px;">Student Status Overview</h3>
          <div style="height: 300px;">
            <canvas id="studentStatusChart"></canvas>
          </div>
        </div>
      </div>
    `;
    
    // Initialize charts after DOM is ready
    setTimeout(() => {
      pages.initializeDashboardCharts();
    }, 100);
  },

  initializeDashboardCharts() {
    console.log('Initializing dashboard charts...');
    
    // Check if Chart.js is loaded
    if (typeof Chart === 'undefined') {
      console.error('Chart.js is not loaded');
      return;
    }

    // Destroy existing charts
    Object.values(chartInstances).forEach(chart => {
      if (chart) chart.destroy();
    });

    // Course Attendance Bar Chart
    const courseCanvas = document.getElementById('courseAttendanceChart');
    if (!courseCanvas) {
      console.error('Course attendance chart canvas not found');
      return;
    }
    const courseCtx = courseCanvas.getContext('2d');
    chartInstances.courseAttendance = new Chart(courseCtx, {
      type: 'bar',
      data: {
        labels: ['CS 101', 'IT 201', 'SE 301', 'DBMS', 'Web Dev', 'Networking'],
        datasets: [{
          label: 'Attendance Rate (%)',
          data: [92, 85, 78, 88, 82, 90],
          backgroundColor: [
            '#1a3e6c', '#436ea3', '#f0c75e', '#2c5282', '#4a90a4', '#36648b'
          ],
          borderColor: [
            '#15325a', '#385d8a', '#d4af37', '#234b72', '#3a7a8c', '#2d5270'
          ],
          borderWidth: 1
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        scales: {
          y: {
            beginAtZero: true,
            max: 100,
            ticks: {
              callback: function(value) {
                return value + '%';
              }
            }
          }
        },
        plugins: {
          legend: {
            display: false
          },
          tooltip: {
            callbacks: {
              label: function(context) {
                return `Attendance: ${context.parsed.y}%`;
              }
            }
          }
        }
      }
    });

    // Weekly Trend Line Chart
    const trendCanvas = document.getElementById('weeklyTrendChart');
    if (!trendCanvas) {
      console.error('Weekly trend chart canvas not found');
      return;
    }
    const trendCtx = trendCanvas.getContext('2d');
    chartInstances.weeklyTrend = new Chart(trendCtx, {
      type: 'line',
      data: {
        labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
        datasets: [{
          label: 'Attendance Rate',
          data: [82, 85, 88, 90, 87, 45],
          borderColor: '#1a3e6c',
          backgroundColor: 'rgba(26, 62, 108, 0.1)',
          tension: 0.4,
          fill: true
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        scales: {
          y: {
            beginAtZero: true,
            max: 100,
            ticks: {
              callback: function(value) {
                return value + '%';
              }
            }
          }
        },
        plugins: {
          tooltip: {
            callbacks: {
              label: function(context) {
                return `Attendance: ${context.parsed.y}%`;
              }
            }
          }
        }
      }
    });

    // Daily Attendance Doughnut Chart
    const dailyCanvas = document.getElementById('dailyAttendanceChart');
    if (!dailyCanvas) {
      console.error('Daily attendance chart canvas not found');
      return;
    }
    const dailyCtx = dailyCanvas.getContext('2d');
    chartInstances.dailyAttendance = new Chart(dailyCtx, {
      type: 'doughnut',
      data: {
        labels: ['Present', 'Absent', 'Late', 'Excused'],
        datasets: [{
          data: [1142, 85, 42, 15],
          backgroundColor: [
            '#4caf50',
            '#f44336',
            '#ff9800',
            '#9e9e9e'
          ],
          borderWidth: 2,
          borderColor: '#fff'
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          legend: {
            position: 'bottom'
          },
          tooltip: {
            callbacks: {
              label: function(context) {
                const total = context.dataset.data.reduce((a, b) => a + b, 0);
                const percentage = ((context.parsed / total) * 100).toFixed(1);
                return `${context.label}: ${context.parsed} (${percentage}%)`;
              }
            }
          }
        }
      }
    });

    // Student Status Pie Chart
    const statusCanvas = document.getElementById('studentStatusChart');
    if (!statusCanvas) {
      console.error('Student status chart canvas not found');
      return;
    }
    const statusCtx = statusCanvas.getContext('2d');
    chartInstances.studentStatus = new Chart(statusCtx, {
      type: 'pie',
      data: {
        labels: ['Active', 'Inactive', 'Pending', 'Suspended'],
        datasets: [{
          data: [1142, 85, 42, 15],
          backgroundColor: [
            '#1a3e6c',
            '#436ea3',
            '#f0c75e',
            '#f44336'
          ],
          borderWidth: 2,
          borderColor: '#fff'
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          legend: {
            position: 'bottom'
          },
          tooltip: {
            callbacks: {
              label: function(context) {
                const total = context.dataset.data.reduce((a, b) => a + b, 0);
                const percentage = ((context.parsed / total) * 100).toFixed(1);
                return `${context.label}: ${context.parsed} (${percentage}%)`;
              }
            }
          }
        }
      }
    });
  },

  // ... (other page methods remain the same until reports)

  reports() {
    document.getElementById('app').innerHTML = `
      <div class="page-header">
        <h1 class="page-title">Attendance Reports</h1>
        <div style="display: flex; gap: 12px;">
          <button class="btn btn-accent" onclick="exportReport('excel')">
            <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
            </svg>
            Export Excel
          </button>
          <button class="btn btn-accent" onclick="exportReport('pdf')">
            <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
            </svg>
            Export PDF
          </button>
        </div>
      </div>
      <div class="grid grid-cols-2">
        <div class="card">
          <h3 style="font-weight: 600; margin-bottom: 16px;">Monthly Attendance Trend</h3>
          <div style="height: 250px;">
            <canvas id="monthlyTrendChart"></canvas>
          </div>
        </div>
        <div class="card">
          <h3 style="font-weight: 600; margin-bottom: 16px;">Subject-wise Performance</h3>
          <div style="height: 250px;">
            <canvas id="subjectPerformanceChart"></canvas>
          </div>
        </div>
      </div>
      <div class="grid grid-cols-2" style="margin-top: 24px;">
        <div class="card">
          <h3 style="font-weight: 600; margin-bottom: 16px;">Attendance Heatmap (Last 30 Days)</h3>
          <div style="height: 300px;">
            <canvas id="attendanceHeatmapChart"></canvas>
          </div>
        </div>
        <div class="card">
          <h3 style="font-weight: 600; margin-bottom: 16px;">Time-based Attendance Analysis</h3>
          <div style="height: 300px;">
            <canvas id="timeAnalysisChart"></canvas>
          </div>
        </div>
      </div>
      <div class="card" style="margin-top: 24px;">
        <div class="filters">
          <div class="search-container">
            <svg class="search-icon" width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
            </svg>
            <input type="text" class="search-input" placeholder="Search...">
          </div>
          <select class="form-select" style="width: 180px;">
            <option value="">All Subjects</option>
            <option value="cs">Computer Science 101</option>
            <option value="db">Database Management</option>
          </select>
          <select class="form-select" style="width: 150px;">
            <option value="">All Statuses</option>
            <option value="present">Present</option>
            <option value="absent">Absent</option>
            <option value="late">Late</option>
          </select>
          <button class="btn btn-primary">
            <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/>
            </svg>
            Apply Filters
          </button>
        </div>
        <div class="table-container">
          <table>
            <thead>
              <tr>
                <th>Student</th>
                <th>Subject</th>
                <th>Date</th>
                <th>Status</th>
                <th>Duration</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>Alex Johnson</td>
                <td>Computer Science 101</td>
                <td>2023-10-15</td>
                <td><span class="status-badge" style="background-color: rgba(76, 175, 80, 0.1); color: #4caf50;">Present</span></td>
                <td>1h 30m</td>
              </tr>
              <tr>
                <td>Jessica Williams</td>
                <td>Database Management</td>
                <td>2023-10-15</td>
                <td><span class="status-badge" style="background-color: rgba(244, 67, 54, 0.1); color: #f44336;">Absent</span></td>
                <td>-</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    `;
    
    // Initialize report charts
    setTimeout(() => {
      pages.initializeReportCharts();
    }, 100);
  },

  initializeReportCharts() {
    console.log('Initializing report charts...');
    
    // Check if Chart.js is loaded
    if (typeof Chart === 'undefined') {
      console.error('Chart.js is not loaded');
      return;
    }

    // Destroy existing charts
    Object.values(chartInstances).forEach(chart => {
      if (chart) chart.destroy();
    });

    // Monthly Trend Line Chart
    const monthlyCanvas = document.getElementById('monthlyTrendChart');
    if (!monthlyCanvas) {
      console.error('Monthly trend chart canvas not found');
      return;
    }
    const monthlyCtx = monthlyCanvas.getContext('2d');
    chartInstances.monthlyTrend = new Chart(monthlyCtx, {
      type: 'line',
      data: {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct'],
        datasets: [{
          label: 'Average Attendance (%)',
          data: [85, 82, 88, 90, 87, 92, 89, 91, 86, 85],
          borderColor: '#1a3e6c',
          backgroundColor: 'rgba(26, 62, 108, 0.1)',
          tension: 0.4,
          fill: true
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        scales: {
          y: {
            beginAtZero: true,
            max: 100,
            ticks: {
              callback: function(value) {
                return value + '%';
              }
            }
          }
        }
      }
    });

    // Subject Performance Bar Chart
    const subjectCanvas = document.getElementById('subjectPerformanceChart');
    if (!subjectCanvas) {
      console.error('Subject performance chart canvas not found');
      return;
    }
    const subjectCtx = subjectCanvas.getContext('2d');
    chartInstances.subjectPerformance = new Chart(subjectCtx, {
      type: 'bar',
      data: {
        labels: ['CS 101', 'IT 201', 'SE 301', 'DBMS', 'Web Dev'],
        datasets: [{
          label: 'Attendance Rate',
          data: [92, 85, 78, 88, 82],
          backgroundColor: '#436ea3',
          borderColor: '#1a3e6c',
          borderWidth: 1
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        scales: {
          y: {
            beginAtZero: true,
            max: 100,
            ticks: {
              callback: function(value) {
                return value + '%';
              }
            }
          }
        }
      }
    });

    // Attendance Heatmap
    const heatmapCanvas = document.getElementById('attendanceHeatmapChart');
    if (!heatmapCanvas) {
      console.error('Attendance heatmap chart canvas not found');
      return;
    }
    const heatmapCtx = heatmapCanvas.getContext('2d');
    chartInstances.attendanceHeatmap = new Chart(heatmapCtx, {
      type: 'bar',
      data: {
        labels: ['Week 1', 'Week 2', 'Week 3', 'Week 4'],
        datasets: [
          {
            label: 'Present',
            data: [45, 52, 48, 55],
            backgroundColor: '#4caf50'
          },
          {
            label: 'Absent',
            data: [5, 3, 7, 2],
            backgroundColor: '#f44336'
          },
          {
            label: 'Late',
            data: [3, 2, 4, 1],
            backgroundColor: '#ff9800'
          }
        ]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        scales: {
          x: {
            stacked: true
          },
          y: {
            stacked: true
          }
        }
      }
    });

    // Time Analysis Chart
    const timeCanvas = document.getElementById('timeAnalysisChart');
    if (!timeCanvas) {
      console.error('Time analysis chart canvas not found');
      return;
    }
    const timeCtx = timeCanvas.getContext('2d');
    chartInstances.timeAnalysis = new Chart(timeCtx, {
      type: 'line',
      data: {
        labels: ['8:00', '9:00', '10:00', '11:00', '12:00', '13:00', '14:00', '15:00', '16:00'],
        datasets: [{
          label: 'Check-ins',
          data: [120, 280, 320, 180, 90, 250, 310, 290, 150],
          borderColor: '#f0c75e',
          backgroundColor: 'rgba(240, 199, 94, 0.1)',
          tension: 0.4,
          fill: true
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        scales: {
          y: {
            beginAtZero: true
          }
        }
      }
    });
  },

  // Placeholder page methods for other routes
  instructors() {
    document.getElementById('app').innerHTML = `
      <div class="page-header">
        <h1 class="page-title">Manage Instructors</h1>
        <button class="btn btn-primary" onclick="showAddInstructorModal()">
          <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
          </svg>
          Add Instructor
        </button>
      </div>
      <div class="card">
        <div class="filters">
          <div class="search-container">
            <svg class="search-icon" width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
            </svg>
            <input type="text" class="search-input" placeholder="Search instructors...">
          </div>
        </div>
        <div class="table-container">
          <table>
            <thead>
              <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Subject</th>
                <th>Section</th>
                <th>Status</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>Dr. John Smith</td>
                <td>john.smith@university.edu</td>
                <td>Computer Science 101</td>
                <td>CS-1A</td>
                <td><span class="status-badge active">Active</span></td>
                <td class="action-icons">
                  <button class="icon-btn" title="Edit">
                    <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                    </svg>
                  </button>
                  <button class="icon-btn delete" title="Delete">
                    <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                    </svg>
                  </button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    `;
  },

  students() {
    document.getElementById('app').innerHTML = `
      <div class="page-header">
        <h1 class="page-title">Manage Students</h1>
        <button class="btn btn-primary">
          <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
          </svg>
          Add Student
        </button>
      </div>
      <div class="card">
        <div class="filters">
          <div class="search-container">
            <svg class="search-icon" width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
            </svg>
            <input type="text" class="search-input" placeholder="Search students...">
          </div>
          <select class="form-select" style="width: 150px;">
            <option value="">All Courses</option>
            <option value="cs">Computer Science</option>
            <option value="it">Information Technology</option>
          </select>
        </div>
        <div class="table-container">
          <table>
            <thead>
              <tr>
                <th>Student ID</th>
                <th>Name</th>
                <th>Course</th>
                <th>Year Level</th>
                <th>Status</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>2023-001</td>
                <td>Alex Johnson</td>
                <td>Computer Science</td>
                <td>3rd Year</td>
                <td><span class="status-badge active">Active</span></td>
                <td class="action-icons">
                  <button class="icon-btn" title="Edit">
                    <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                    </svg>
                  </button>
                  <button class="icon-btn delete" title="Delete">
                    <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                    </svg>
                  </button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    `;
  },

  correctionRequests() {
    document.getElementById('app').innerHTML = `
      <div class="page-header">
        <h1 class="page-title">Correction Requests</h1>
      </div>
      <div class="card">
        <div class="table-container">
          <table>
            <thead>
              <tr>
                <th>Student</th>
                <th>Subject</th>
                <th>Date</th>
                <th>Current Status</th>
                <th>Requested Status</th>
                <th>Reason</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>Alex Johnson</td>
                <td>CS 101</td>
                <td>2023-10-15</td>
                <td><span class="status-badge" style="background-color: rgba(244, 67, 54, 0.1); color: #f44336;">Absent</span></td>
                <td><span class="status-badge" style="background-color: rgba(76, 175, 80, 0.1); color: #4caf50;">Present</span></td>
                <td>Was present but marked absent</td>
                <td class="action-icons">
                  <button class="icon-btn approve" title="Approve">
                    <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                  </button>
                  <button class="icon-btn deny" title="Deny">
                    <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                  </button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    `;
  },

  deviceRequests() {
    document.getElementById('app').innerHTML = `
      <div class="page-header">
        <h1 class="page-title">Device Change Requests</h1>
      </div>
      <div class="card">
        <div class="table-container">
          <table>
            <thead>
              <tr>
                <th>Student</th>
                <th>Current Device</th>
                <th>New Device</th>
                <th>Reason</th>
                <th>Date Requested</th>
                <th>Status</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>Jessica Williams</td>
                <td>iPhone 12</td>
                <td>iPhone 14</td>
                <td>Device malfunction</td>
                <td>2023-10-14</td>
                <td><span class="status-badge pending">Pending</span></td>
                <td class="action-icons">
                  <button class="icon-btn approve" title="Approve">
                    <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                  </button>
                  <button class="icon-btn deny" title="Deny">
                    <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                  </button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    `;
  },

  passwordRequests() {
    document.getElementById('app').innerHTML = `
      <div class="page-header">
        <h1 class="page-title">Password Change Requests</h1>
      </div>
      <div class="card">
        <div class="table-container">
          <table>
            <thead>
              <tr>
                <th>User</th>
                <th>Role</th>
                <th>Request Date</th>
                <th>Status</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>Mike Davis</td>
                <td>Student</td>
                <td>2023-10-13</td>
                <td><span class="status-badge pending">Pending</span></td>
                <td class="action-icons">
                  <button class="icon-btn approve" title="Reset Password">
                    <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"/>
                    </svg>
                  </button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    `;
  },

  rescheduleRequests() {
    document.getElementById('app').innerHTML = `
      <div class="page-header">
        <h1 class="page-title">Reschedule Requests</h1>
      </div>
      <div class="card">
        <div class="table-container">
          <table>
            <thead>
              <tr>
                <th>Student</th>
                <th>Subject</th>
                <th>Original Date</th>
                <th>Requested Date</th>
                <th>Reason</th>
                <th>Status</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>Sarah Wilson</td>
                <td>IT 201</td>
                <td>2023-10-16</td>
                <td>2023-10-18</td>
                <td>Medical appointment</td>
                <td><span class="status-badge pending">Pending</span></td>
                <td class="action-icons">
                  <button class="icon-btn approve" title="Approve">
                    <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                  </button>
                  <button class="icon-btn deny" title="Deny">
                    <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                  </button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    `;
  },

  gps() {
    document.getElementById('app').innerHTML = `
      <div class="page-header">
        <h1 class="page-title">GPS Settings</h1>
      </div>
      <div class="grid grid-cols-2">
        <div class="card">
          <h3 style="font-weight: 600; margin-bottom: 16px;">Location Settings</h3>
          <div class="form-group">
            <label class="form-label">University Location</label>
            <input type="text" class="form-input" value="University of Example, Main Campus">
          </div>
          <div class="form-group">
            <label class="form-label">GPS Radius (meters)</label>
            <input type="number" class="form-input" value="100">
          </div>
          <div class="form-group">
            <label class="form-label">Enable GPS Tracking</label>
            <label class="switch">
              <input type="checkbox" checked>
              <span class="slider"></span>
            </label>
          </div>
          <button class="btn btn-primary">Save Settings</button>
        </div>
        <div class="card">
          <h3 style="font-weight: 600; margin-bottom: 16px;">Location Map</h3>
          <div id="map"></div>
        </div>
      </div>
    `;
    
    // Initialize map after DOM is ready
    setTimeout(() => {
      if (typeof L !== 'undefined') {
        const map = L.map('map').setView([14.5995, 120.9842], 15);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);
        L.marker([14.5995, 120.9842]).addTo(map).bindPopup('University Location');
      }
    }, 100);
  },

  settings() {
    document.getElementById('app').innerHTML = `
      <div class="page-header">
        <h1 class="page-title">Account Settings</h1>
      </div>
      <div class="grid grid-cols-2">
        <div class="card">
          <h3 style="font-weight: 600; margin-bottom: 16px;">Profile Information</h3>
          <div class="form-group">
            <label class="form-label">Full Name</label>
            <input type="text" class="form-input" value="Dean Martinez">
          </div>
          <div class="form-group">
            <label class="form-label">Email</label>
            <input type="email" class="form-input" value="dean.martinez@university.edu">
          </div>
          <div class="form-group">
            <label class="form-label">Position</label>
            <input type="text" class="form-input" value="Dean of Computer Studies">
          </div>
          <button class="btn btn-primary">Update Profile</button>
        </div>
        <div class="card">
          <h3 style="font-weight: 600; margin-bottom: 16px;">Security Settings</h3>
          <div class="form-group">
            <label class="form-label">Current Password</label>
            <input type="password" class="form-input">
          </div>
          <div class="form-group">
            <label class="form-label">New Password</label>
            <input type="password" class="form-input">
          </div>
          <div class="form-group">
            <label class="form-label">Confirm New Password</label>
            <input type="password" class="form-input">
          </div>
          <button class="btn btn-primary">Change Password</button>
        </div>
      </div>
    `;
  }

};

// Global functions
function showAddInstructorModal() {
  const modal = document.createElement('div');
  modal.className = 'modal';
  modal.innerHTML = `
    <div class="modal-content">
      <h3 class="modal-header">Add New Instructor</h3>
      <form>
        <div class="grid grid-cols-2" style="gap: 16px;">
          <div class="form-group">
            <label class="form-label">First Name</label>
            <input type="text" class="form-input">
          </div>
          <div class="form-group">
            <label class="form-label">Last Name</label>
            <input type="text" class="form-input">
          </div>
        </div>
        <div class="form-group">
          <label class="form-label">Email</label>
          <input type="email" class="form-input">
        </div>
        <div class="form-group">
          <label class="form-label">Password</label>
          <input type="password" class="form-input">
        </div>
        <div class="form-group">
          <label class="form-label">Subject</label>
          <input type="text" class="form-input">
        </div>
        <div class="form-group">
          <label class="form-label">Section</label>
          <input type="text" class="form-input">
        </div>
        <div class="grid grid-cols-2" style="gap: 16px;">
          <div class="form-group">
            <label class="form-label">Day</label>
            <select class="form-select">
              <option value="">Select days</option>
              <option value="mwf">Mon/Wed/Fri</option>
              <option value="tth">Tue/Thu</option>
            </select>
          </div>
          <div class="form-group">
            <label class="form-label">Time</label>
            <input type="text" class="form-input" placeholder="e.g. 9:00-10:30 AM">
          </div>
        </div>
        <div class="modal-actions">
          <button type="button" class="btn" style="background: transparent; color: #4a4a4a;" onclick="this.closest('.modal').remove()">Cancel</button>
          <button type="submit" class="btn btn-primary">Add Instructor</button>
        </div>
      </form>
    </div>
  `;
  document.body.appendChild(modal);
  
  modal.addEventListener('click', (e) => {
    if (e.target === modal) {
      modal.remove();
    }
  });
}

function exportReport(format) {
  alert(`Exporting report as ${format.toUpperCase()}...`);
  // In a real application, this would trigger a download
}

function showLogoutModal() {
  const modal = document.createElement('div');
  modal.className = 'modal';
  modal.innerHTML = `
    <div class="modal-content">
      <div class="logout-modal-header">
        <svg width="24" height="24" fill="none" stroke="#ff4444" viewBox="0 0 24 24" style="margin-bottom: 16px;">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z"/>
        </svg>
        <h3 class="modal-header">Confirm Logout</h3>
        <p style="color: #6e6e6e; font-size: 14px; margin-bottom: 24px;">Are you sure you want to logout from your account?</p>
      </div>
      <div class="modal-actions">
        <button type="button" class="btn btn-cancel" onclick="this.closest('.modal').remove()">
          Cancel
        </button>
        <button type="button" class="btn btn-logout" onclick="confirmLogout()">
          <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
          </svg>
          Logout
        </button>
      </div>
    </div>
  `;
  document.body.appendChild(modal);
  
  modal.addEventListener('click', (e) => {
    if (e.target === modal) {
      modal.remove();
    }
  });
}

function confirmLogout() {
  // Close the modal first
  document.querySelector('.modal').remove();
  
  // Show logout confirmation
  alert('You have been logged out successfully.');
  
  // In a real application, you would redirect to login page
  // window.location.href = 'login.php';
}

// Initialize app
app.init();