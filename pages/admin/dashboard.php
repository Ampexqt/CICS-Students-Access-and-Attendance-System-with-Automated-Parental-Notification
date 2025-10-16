<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CICS Attendance System</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Poppins', sans-serif;
      background-color: #f4f7fb;
      color: #4a4a4a;
    }

    .hidden {
      display: none !important;
    }

    /* Sidebar Styles */
    .sidebar {
      position: fixed;
      left: 0;
      top: 0;
      width: 256px;
      height: 100vh;
      background-color: #1a3e6c;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
      z-index: 10;
      overflow-y: auto;
    }

    .sidebar-header {
      padding: 24px;
      text-align: center;
      margin-bottom: 32px;
    }

    .sidebar-header h1 {
      color: white;
      font-size: 20px;
      font-weight: 700;
    }

    .nav-item {
      margin-bottom: 4px;
      position: relative;
    }

    .nav-link {
      display: flex;
      align-items: center;
      padding: 12px 16px;
      color: rgba(255, 255, 255, 0.8);
      text-decoration: none;
      border-radius: 8px;
      transition: all 0.2s;
      font-size: 14px;
      font-weight: 500;
      cursor: pointer;
    }

    .nav-link:hover {
      color: white;
      background-color: rgba(67, 110, 163, 0.7);
    }

    .nav-link.active {
      color: white;
      background-color: #436ea3;
    }

    .nav-link.active::before {
      content: '';
      position: absolute;
      left: 0;
      top: 0;
      bottom: 0;
      width: 4px;
      background-color: #f0c75e;
      border-radius: 0 8px 8px 0;
    }

    .nav-icon {
      margin-right: 12px;
      width: 20px;
      height: 20px;
    }

    .submenu {
      margin-left: 24px;
      margin-top: 4px;
      display: none;
    }

    .submenu.open {
      display: block;
    }

    .submenu-item {
      display: flex;
      align-items: center;
      padding: 8px 16px;
    }

    .submenu-dot {
      width: 8px;
      height: 8px;
      border-radius: 50%;
      background-color: rgba(255, 255, 255, 0.8);
      margin-right: 8px;
    }

    /* TopBar Styles */
    .topbar {
      position: fixed;
      top: 0;
      right: 0;
      left: 256px;
      height: 64px;
      background-color: white;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 0 24px;
      z-index: 9;
    }

    .topbar-title {
      color: #1a3e6c;
      font-size: 18px;
      font-weight: 600;
    }

    .topbar-actions {
      display: flex;
      align-items: center;
      gap: 16px;
    }

    .notification-btn {
      position: relative;
      background: none;
      border: none;
      cursor: pointer;
      color: #4a4a4a;
    }

    .notification-badge {
      position: absolute;
      top: -4px;
      right: -4px;
      background-color: #f0c75e;
      color: white;
      font-size: 10px;
      width: 16px;
      height: 16px;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .profile-btn {
      display: flex;
      align-items: center;
      gap: 8px;
      background: none;
      border: none;
      cursor: pointer;
      color: #4a4a4a;
      font-weight: 500;
    }

    .profile-avatar {
      width: 32px;
      height: 32px;
      border-radius: 50%;
      background-color: #1a3e6c;
      color: white;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 14px;
    }

    /* Main Content */
    .main-content {
      margin-left: 256px;
      margin-top: 64px;
      padding: 32px 24px;
    }

    /* Card Styles */
    .card {
      background-color: white;
      border-radius: 12px;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
      padding: 24px;
    }

    .stat-card {
      background-color: white;
      border-radius: 12px;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
      padding: 24px;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .stat-card-content h3 {
      font-size: 24px;
      font-weight: 700;
      color: #4a4a4a;
    }

    .stat-card-content p {
      font-size: 14px;
      color: #6e6e6e;
    }

    .stat-card-icon {
      width: 48px;
      height: 48px;
      border-radius: 8px;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .stat-card-icon.primary {
      background-color: #1a3e6c;
    }

    .stat-card-icon.secondary {
      background-color: #436ea3;
    }

    .stat-card-icon.accent {
      background-color: #f0c75e;
    }

    /* Grid System */
    .grid {
      display: grid;
      gap: 24px;
    }

    .grid-cols-4 {
      grid-template-columns: repeat(4, 1fr);
    }

    .grid-cols-2 {
      grid-template-columns: repeat(2, 1fr);
    }

    .grid-cols-3 {
      grid-template-columns: repeat(3, 1fr);
    }

    /* Button Styles */
    .btn {
      padding: 8px 16px;
      border-radius: 8px;
      border: none;
      cursor: pointer;
      font-weight: 500;
      font-size: 14px;
      display: inline-flex;
      align-items: center;
      gap: 8px;
      transition: all 0.2s;
    }

    .btn-primary {
      background-color: #1a3e6c;
      color: white;
    }

    .btn-primary:hover {
      background-color: #15325a;
    }

    .btn-secondary {
      background-color: #436ea3;
      color: white;
    }

    .btn-accent {
      background-color: #f0c75e;
      color: #1a3e6c;
    }

    /* Table Styles */
    .table-container {
      overflow-x: auto;
      margin-top: 24px;
    }

    table {
      width: 100%;
      border-collapse: collapse;
    }

    thead tr {
      background-color: #f4f7fb;
    }

    th {
      padding: 12px 16px;
      text-align: left;
      font-size: 12px;
      font-weight: 500;
      color: #6e6e6e;
      text-transform: uppercase;
      letter-spacing: 0.5px;
    }

    td {
      padding: 12px 16px;
      font-size: 14px;
      border-top: 1px solid #f0f0f0;
    }

    .status-badge {
      display: inline-block;
      padding: 4px 10px;
      border-radius: 12px;
      font-size: 12px;
      font-weight: 500;
    }

    .status-badge.pending {
      background-color: rgba(240, 199, 94, 0.2);
      color: #f0c75e;
    }

    .status-badge.approved {
      background-color: rgba(76, 175, 80, 0.1);
      color: #4caf50;
    }

    .status-badge.denied {
      background-color: rgba(158, 158, 158, 0.1);
      color: #9e9e9e;
    }

    .status-badge.active {
      background-color: rgba(76, 175, 80, 0.1);
      color: #4caf50;
    }

    .status-badge.inactive {
      background-color: rgba(158, 158, 158, 0.1);
      color: #9e9e9e;
    }

    /* Search Input */
    .search-container {
      position: relative;
      width: 256px;
    }

    .search-input {
      width: 100%;
      padding: 8px 12px 8px 40px;
      border: 1px solid #e0e0e0;
      border-radius: 8px;
      font-size: 14px;
    }

    .search-input:focus {
      outline: none;
      border-color: #1a3e6c;
      box-shadow: 0 0 0 2px rgba(26, 62, 108, 0.1);
    }

    .search-icon {
      position: absolute;
      left: 12px;
      top: 50%;
      transform: translateY(-50%);
      color: #6e6e6e;
    }

    /* Modal Styles */
    .modal {
      position: fixed;
      inset: 0;
      background-color: rgba(0, 0, 0, 0.5);
      display: flex;
      align-items: center;
      justify-content: center;
      z-index: 50;
    }

    .modal-content {
      background-color: white;
      border-radius: 12px;
      padding: 24px;
      width: 90%;
      max-width: 500px;
      max-height: 90vh;
      overflow-y: auto;
    }

    .modal-header {
      font-size: 18px;
      font-weight: 600;
      color: #1a3e6c;
      margin-bottom: 16px;
    }

    .form-group {
      margin-bottom: 16px;
    }

    .form-label {
      display: block;
      font-size: 14px;
      font-weight: 500;
      color: #6e6e6e;
      margin-bottom: 4px;
    }

    .form-input, .form-select {
      width: 100%;
      padding: 8px 12px;
      border: 1px solid #e0e0e0;
      border-radius: 8px;
      font-size: 14px;
    }

    .form-input:focus, .form-select:focus {
      outline: none;
      border-color: #1a3e6c;
      box-shadow: 0 0 0 2px rgba(26, 62, 108, 0.1);
    }

    .modal-actions {
      display: flex;
      justify-content: flex-end;
      gap: 12px;
      margin-top: 24px;
    }

    /* Map Container */
    #map {
      height: 400px;
      border-radius: 8px;
      overflow: hidden;
      border: 1px solid #e0e0e0;
    }

    /* Tabs */
    .tabs {
      border-bottom: 1px solid #f0f0f0;
      display: flex;
    }

    .tab-btn {
      padding: 16px 24px;
      background: none;
      border: none;
      border-bottom: 2px solid transparent;
      cursor: pointer;
      font-weight: 500;
      font-size: 14px;
      color: #6e6e6e;
      display: flex;
      align-items: center;
      gap: 8px;
    }

    .tab-btn.active {
      color: #1a3e6c;
      border-bottom-color: #1a3e6c;
    }

    .tab-btn:hover {
      color: #4a4a4a;
    }

    .tab-content {
      padding: 24px 0;
    }

    /* Action Icons */
    .action-icons {
      display: flex;
      gap: 8px;
    }

    .icon-btn {
      background: none;
      border: none;
      cursor: pointer;
      padding: 4px;
      color: #436ea3;
    }

    .icon-btn:hover {
      color: #1a3e6c;
    }

    .icon-btn.delete:hover {
      color: #f44336;
    }

    .icon-btn.approve:hover {
      color: #4caf50;
    }

    .icon-btn.deny:hover {
      color: #f44336;
    }

    /* Responsive */
    @media (max-width: 1024px) {
      .grid-cols-4 {
        grid-template-columns: repeat(2, 1fr);
      }
      .grid-cols-2 {
        grid-template-columns: 1fr;
      }
    }

    @media (max-width: 768px) {
      .sidebar {
        transform: translateX(-100%);
      }
      .topbar, .main-content {
        margin-left: 0;
        left: 0;
      }
      .grid-cols-4, .grid-cols-3 {
        grid-template-columns: 1fr;
      }
    }

    /* Page specific styles */
    .page-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 24px;
    }

    .page-title {
      font-size: 24px;
      font-weight: 700;
      color: #1a3e6c;
    }

    .filters {
      display: flex;
      gap: 12px;
      align-items: center;
      margin-bottom: 24px;
    }

    /* Chart placeholder */
    .chart-placeholder {
      height: 100%;
      display: flex;
      align-items: center;
      justify-content: center;
      color: #9e9e9e;
      font-size: 14px;
    }
  </style>
</head>
<body>
  <!-- Sidebar -->
  <div class="sidebar">
    <div class="sidebar-header">
      <h1>CICS Attendance</h1>
    </div>
    <nav style="padding: 0 24px;">
      <div class="nav-item">
        <a href="#/" class="nav-link" data-route="/">
          <svg class="nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
          </svg>
          <span>Dashboard</span>
        </a>
      </div>
      <div class="nav-item">
        <a href="#/instructors" class="nav-link" data-route="/instructors">
          <svg class="nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
          </svg>
          <span>Manage Instructors</span>
        </a>
      </div>
      <div class="nav-item">
        <a href="#/students" class="nav-link" data-route="/students">
          <svg class="nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
          </svg>
          <span>Manage Students</span>
        </a>
      </div>
      <div class="nav-item">
        <a href="#/requests" class="nav-link" data-route="/requests" id="requests-toggle">
          <svg class="nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
          </svg>
          <span>Requests</span>
        </a>
        <div class="submenu" id="requests-submenu">
          <div class="nav-item submenu-item">
            <a href="#/requests/correction" class="nav-link" data-route="/requests/correction">
              <span class="submenu-dot"></span>
              <span>Correction Requests</span>
            </a>
          </div>
          <div class="nav-item submenu-item">
            <a href="#/requests/device" class="nav-link" data-route="/requests/device">
              <span class="submenu-dot"></span>
              <span>Device Change Requests</span>
            </a>
          </div>
          <div class="nav-item submenu-item">
            <a href="#/requests/password" class="nav-link" data-route="/requests/password">
              <span class="submenu-dot"></span>
              <span>Password Change Requests</span>
            </a>
          </div>
          <div class="nav-item submenu-item">
            <a href="#/requests/reschedule" class="nav-link" data-route="/requests/reschedule">
              <span class="submenu-dot"></span>
              <span>Reschedule Requests</span>
            </a>
          </div>
        </div>
      </div>
      <div class="nav-item">
        <a href="#/reports" class="nav-link" data-route="/reports">
          <svg class="nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
          </svg>
          <span>Attendance Reports</span>
        </a>
      </div>
      <div class="nav-item">
        <a href="#/gps" class="nav-link" data-route="/gps">
          <svg class="nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
          </svg>
          <span>GPS Settings</span>
        </a>
      </div>
      <div class="nav-item">
        <a href="#/settings" class="nav-link" data-route="/settings">
          <svg class="nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
          </svg>
          <span>Account Settings</span>
        </a>
      </div>
      <div class="nav-item" style="padding-top: 24px;">
        <a href="#/logout" class="nav-link" data-route="/logout">
          <svg class="nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
          </svg>
          <span>Logout</span>
        </a>
      </div>
    </nav>
  </div>

  <!-- TopBar -->
  <div class="topbar">
    <div class="topbar-title" id="page-title">Dashboard</div>
    <div class="topbar-actions">
      <button class="notification-btn">
        <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
        </svg>
        <span class="notification-badge">3</span>
      </button>
      <button class="profile-btn">
        <div class="profile-avatar">DM</div>
        <span>Dean Martinez</span>
        <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
        </svg>
      </button>
    </div>
  </div>

  <!-- Main Content -->
  <div class="main-content" id="app"></div>

  <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
  <script>
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
          if (link.dataset.route === hash || (hash.includes('/requests') && link.dataset.route === '/requests')) {
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
              <div class="chart-placeholder" style="height: 250px;">Chart: Bar Chart</div>
            </div>
            <div class="card">
              <h3 style="font-weight: 600; margin-bottom: 16px;">Weekly Attendance Trend</h3>
              <div class="chart-placeholder" style="height: 250px;">Chart: Line Chart</div>
            </div>
          </div>
        `;
      },

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
              <select class="form-select" style="width: 150px;">
                <option value="">All Subjects</option>
                <option value="cs">Computer Science</option>
                <option value="it">Information Technology</option>
              </select>
              <select class="form-select" style="width: 150px;">
                <option value="">All Sections</option>
                <option value="cs1">CS-1</option>
                <option value="it2">IT-2</option>
              </select>
            </div>
            <div class="table-container">
              <table>
                <thead>
                  <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Subject</th>
                    <th>Section</th>
                    <th>Schedule</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>Dr. John Smith</td>
                    <td>john.smith@cics.edu</td>
                    <td>Computer Science 101</td>
                    <td>CS-1A</td>
                    <td>MWF 9:00-10:30 AM</td>
                    <td>
                      <div class="action-icons">
                        <button class="icon-btn">
                          <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                          </svg>
                        </button>
                        <button class="icon-btn delete">
                          <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                          </svg>
                        </button>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td>Prof. Maria Rodriguez</td>
                    <td>m.rodriguez@cics.edu</td>
                    <td>Database Management</td>
                    <td>IT-2B</td>
                    <td>TTh 1:00-2:30 PM</td>
                    <td>
                      <div class="action-icons">
                        <button class="icon-btn">
                          <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                          </svg>
                        </button>
                        <button class="icon-btn delete">
                          <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                          </svg>
                        </button>
                      </div>
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
            <div style="display: flex; gap: 12px;">
              <button class="btn btn-secondary">
                <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                </svg>
                Register Device
              </button>
              <button class="btn btn-primary">
                <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Add Student
              </button>
            </div>
          </div>
          <div class="grid grid-cols-3">
            <div class="stat-card">
              <div class="stat-card-content">
                <p>Total Students</p>
                <h3>1,284</h3>
              </div>
              <div class="stat-card-icon primary">
                <svg width="20" height="20" fill="white" viewBox="0 0 24 24">
                  <path d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                </svg>
              </div>
            </div>
            <div class="stat-card">
              <div class="stat-card-content">
                <p>Active Students</p>
                <h3>1,142</h3>
              </div>
              <div class="stat-card-icon secondary">
                <svg width="20" height="20" fill="white" viewBox="0 0 24 24">
                  <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
              </div>
            </div>
            <div class="stat-card">
              <div class="stat-card-content">
                <p>Registered Devices</p>
                <h3>1,205</h3>
              </div>
              <div class="stat-card-icon accent">
                <svg width="20" height="20" fill="#1a3e6c" viewBox="0 0 24 24">
                  <path d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                </svg>
              </div>
            </div>
          </div>
          <div class="card" style="margin-top: 24px;">
            <div class="tabs">
              <button class="tab-btn active">Active Students</button>
              <button class="tab-btn">Inactive Students</button>
              <button class="tab-btn">All Students</button>
            </div>
            <div class="filters" style="margin-top: 24px;">
              <div class="search-container">
                <svg class="search-icon" width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
                <input type="text" class="search-input" placeholder="Search students...">
              </div>
              <select class="form-select" style="width: 150px;">
                <option value="">All Sections</option>
                <option value="cs1a">CS-1A</option>
                <option value="it2b">IT-2B</option>
              </select>
            </div>
            <div class="table-container">
              <table>
                <thead>
                  <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Section</th>
                    <th>Device ID</th>
                    <th>Status</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>Alex Johnson</td>
                    <td>alex.j@student.cics.edu</td>
                    <td>CS-1A</td>
                    <td>CICS-D4562</td>
                    <td><span class="status-badge active">Active</span></td>
                    <td>
                      <div class="action-icons">
                        <button class="icon-btn">
                          <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                          </svg>
                        </button>
                        <button class="icon-btn delete">
                          <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                          </svg>
                        </button>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td>Jessica Williams</td>
                    <td>j.williams@student.cics.edu</td>
                    <td>IT-2B</td>
                    <td>CICS-D7890</td>
                    <td><span class="status-badge active">Active</span></td>
                    <td>
                      <div class="action-icons">
                        <button class="icon-btn">
                          <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                          </svg>
                        </button>
                        <button class="icon-btn delete">
                          <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                          </svg>
                        </button>
                      </div>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        `;
      },

      correctionRequests() {
        pages.renderRequestPage('Correction Requests', [
          { student: 'Alex Johnson', subject: 'Computer Science 101', reason: 'System error during check-in', status: 'Pending', date: '2023-10-15' },
          { student: 'Jessica Williams', subject: 'Database Management', reason: 'Internet connection issue', status: 'Approved', date: '2023-10-14' },
          { student: 'David Brown', subject: 'Web Development', reason: 'App crashed during check-in', status: 'Denied', date: '2023-10-13' }
        ], ['Student', 'Subject', 'Reason', 'Status', 'Date']);
      },

      deviceRequests() {
        pages.renderRequestPage('Device Change Requests', [
          { student: 'Alex Johnson', oldDevice: 'CICS-D4562', newDevice: 'CICS-D7890', reason: 'Old device broken', status: 'Pending' },
          { student: 'Jessica Williams', oldDevice: 'CICS-D7891', newDevice: 'CICS-D8901', reason: 'Lost old device', status: 'Approved' }
        ], ['Student', 'Old Device', 'New Device', 'Reason', 'Status']);
      },

      passwordRequests() {
        pages.renderRequestPage('Password Change Requests', [
          { student: 'Alex Johnson', reason: 'Forgot password', status: 'Pending', dateRequested: '2023-10-15' },
          { student: 'Jessica Williams', reason: 'Security concerns', status: 'Approved', dateRequested: '2023-10-14' }
        ], ['Student', 'Reason', 'Status', 'Date Requested']);
      },

      rescheduleRequests() {
        pages.renderRequestPage('Instructor Reschedule Requests', [
          { instructor: 'Dr. John Smith', subject: 'Computer Science 101', oldDate: '2023-10-15, 9:00-10:30 AM', newDate: '2023-10-18, 9:00-10:30 AM', reason: 'Personal emergency', status: 'Pending' },
          { instructor: 'Prof. Maria Rodriguez', subject: 'Database Management', oldDate: '2023-10-16, 1:00-2:30 PM', newDate: '2023-10-19, 1:00-2:30 PM', reason: 'Department meeting', status: 'Approved' }
        ], ['Instructor', 'Subject', 'Old Date', 'New Date', 'Reason', 'Status']);
      },

      renderRequestPage(title, data, headers) {
        const pendingCount = data.filter(item => item.status === 'Pending').length;
        const rows = data.map(item => {
          const cells = Object.values(item).map(value => {
            if (value === 'Pending' || value === 'Approved' || value === 'Denied') {
              return `<td><span class="status-badge ${value.toLowerCase()}">${value}</span></td>`;
            }
            return `<td>${value}</td>`;
          }).join('');
          
          const actions = item.status === 'Pending' ? `
            <td>
              <div class="action-icons">
                <button class="icon-btn approve">
                  <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                  </svg>
                </button>
                <button class="icon-btn deny">
                  <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                  </svg>
                </button>
              </div>
            </td>
          ` : '<td></td>';
          
          return `<tr>${cells}${actions}</tr>`;
        }).join('');

        document.getElementById('app').innerHTML = `
          <div class="page-header">
            <div>
              <h1 class="page-title">${title}</h1>
              <p style="color: #6e6e6e; margin-top: 4px;">${pendingCount} ${pendingCount === 1 ? 'request' : 'requests'} pending</p>
            </div>
          </div>
          <div class="card">
            <div class="filters">
              <div class="search-container">
                <svg class="search-icon" width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
                <input type="text" class="search-input" placeholder="Search requests...">
              </div>
              <select class="form-select" style="width: 150px;">
                <option value="">All Statuses</option>
                <option value="pending">Pending</option>
                <option value="approved">Approved</option>
                <option value="denied">Denied</option>
              </select>
            </div>
            <div class="table-container">
              <table>
                <thead>
                  <tr>${headers.map(h => `<th>${h}</th>`).join('')}<th>Actions</th></tr>
                </thead>
                <tbody>${rows}</tbody>
              </table>
            </div>
          </div>
        `;
      },

      reports() {
        document.getElementById('app').innerHTML = `
          <div class="page-header">
            <h1 class="page-title">Attendance Reports</h1>
            <div style="display: flex; gap: 12px;">
              <button class="btn btn-accent">
                <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                </svg>
                Export Excel
              </button>
              <button class="btn btn-accent">
                <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                </svg>
                Export PDF
              </button>
            </div>
          </div>
          <div class="grid grid-cols-2">
            <div class="card">
              <h3 style="font-weight: 600; margin-bottom: 16px;">Attendance Trend</h3>
              <div class="chart-placeholder" style="height: 250px;">Chart: Line Chart</div>
            </div>
            <div class="card">
              <h3 style="font-weight: 600; margin-bottom: 16px;">Absence Distribution</h3>
              <div class="chart-placeholder" style="height: 250px;">Chart: Pie Chart</div>
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
      },

      gps() {
        document.getElementById('app').innerHTML = `
          <div class="page-header">
            <h1 class="page-title">GPS Restriction Settings</h1>
          </div>
          <div class="grid grid-cols-3">
            <div class="card">
              <h2 style="font-size: 18px; font-weight: 600; color: #1a3e6c; margin-bottom: 16px;">Campus Location Settings</h2>
              <div class="form-group">
                <label class="form-label">Campus Latitude</label>
                <input type="text" class="form-input" value="14.5995">
              </div>
              <div class="form-group">
                <label class="form-label">Campus Longitude</label>
                <input type="text" class="form-input" value="120.9842">
              </div>
              <div class="form-group">
                <label class="form-label">Radius (in meters)</label>
                <input type="text" class="form-input" value="100">
              </div>
              <button class="btn btn-primary" style="width: 100%; margin-top: 16px;">Save Settings</button>
              <div style="display: flex; align-items: center; justify-content: center; margin-top: 16px; padding: 8px 12px; background-color: rgba(240, 199, 94, 0.1); border-radius: 8px;">
                <svg width="18" height="18" fill="none" stroke="#f0c75e" viewBox="0 0 24 24" style="margin-right: 8px;">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
                <span style="font-size: 14px; font-weight: 500;">Active GPS Restriction</span>
              </div>
            </div>
            <div class="card" style="grid-column: span 2;">
              <h2 style="font-size: 18px; font-weight: 600; color: #1a3e6c; margin-bottom: 16px;">Interactive Map View</h2>
              <div id="map"></div>
              <p style="margin-top: 16px; font-size: 14px; color: #6e6e6e;">
                The blue circle represents the attendance check-in zone. Students must be within this radius to mark their attendance.
              </p>
            </div>
          </div>
        `;
        
        // Initialize map after DOM is ready
        setTimeout(() => {
          const map = L.map('map').setView([14.5995, 120.9842], 16);
          L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors'
          }).addTo(map);
          
          const marker = L.marker([14.5995, 120.9842]).addTo(map);
          const circle = L.circle([14.5995, 120.9842], {
            color: '#1a3e6c',
            fillColor: '#1a3e6c',
            fillOpacity: 0.2,
            radius: 100
          }).addTo(map);
        }, 100);
      },

      settings() {
        document.getElementById('app').innerHTML = `
          <div class="page-header">
            <h1 class="page-title">Account Settings</h1>
          </div>
          <div class="card">
            <div class="tabs">
              <button class="tab-btn active" data-tab="profile">
                <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                </svg>
                Profile
              </button>
              <button class="tab-btn" data-tab="password">
                <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                </svg>
                Password
              </button>
              <button class="tab-btn" data-tab="notifications">
                <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                </svg>
                Notifications
              </button>
              <button class="tab-btn" data-tab="security">
                <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                </svg>
                Security
              </button>
            </div>
            
            <div class="tab-content">
              <div id="profile-tab" class="tab-pane">
                <div style="display: flex; align-items: center; margin-bottom: 32px;">
                  <div style="width: 96px; height: 96px; border-radius: 50%; background-color: #1a3e6c; color: white; display: flex; align-items: center; justify-content: center; font-size: 36px; font-weight: 700; margin-right: 24px;">
                    DM
                  </div>
                  <div>
                    <h2 style="font-size: 20px; font-weight: 600; color: #4a4a4a;">Dean Martinez</h2>
                    <p style="color: #6e6e6e; margin-top: 4px;">dean.martinez@cics.edu</p>
                    <button class="btn btn-secondary" style="margin-top: 8px; padding: 6px 12px; font-size: 12px;">Change Profile Picture</button>
                  </div>
                </div>
                <div class="grid grid-cols-2">
                  <div class="form-group">
                    <label class="form-label">First Name</label>
                    <input type="text" class="form-input" value="Dean">
                  </div>
                  <div class="form-group">
                    <label class="form-label">Last Name</label>
                    <input type="text" class="form-input" value="Martinez">
                  </div>
                  <div class="form-group">
                    <label class="form-label">Email</label>
                    <input type="email" class="form-input" value="dean.martinez@cics.edu">
                  </div>
                  <div class="form-group">
                    <label class="form-label">Phone</label>
                    <input type="text" class="form-input" value="+63 912 345 6789">
                  </div>
                </div>
                <button class="btn btn-primary" style="margin-top: 16px;">Save Changes</button>
              </div>
              
              <div id="password-tab" class="tab-pane hidden">
                <div style="max-width: 500px;">
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
                  <button class="btn btn-primary">Update Password</button>
                </div>
              </div>
              
              <div id="notifications-tab" class="tab-pane hidden">
                <h3 style="font-size: 18px; font-weight: 600; margin-bottom: 24px;">Email Notifications</h3>
                <div style="display: flex; flex-direction: column; gap: 24px;">
                  <div style="display: flex; justify-content: space-between; align-items: center;">
                    <div>
                      <p style="font-weight: 500; color: #4a4a4a;">New Requests</p>
                      <p style="font-size: 14px; color: #6e6e6e; margin-top: 4px;">Get notified when new requests are submitted</p>
                    </div>
                    <label class="switch">
                      <input type="checkbox" checked>
                      <span class="slider"></span>
                    </label>
                  </div>
                  <div style="display: flex; justify-content: space-between; align-items: center;">
                    <div>
                      <p style="font-weight: 500; color: #4a4a4a;">Attendance Reports</p>
                      <p style="font-size: 14px; color: #6e6e6e; margin-top: 4px;">Daily attendance report summary</p>
                    </div>
                    <label class="switch">
                      <input type="checkbox" checked>
                      <span class="slider"></span>
                    </label>
                  </div>
                  <div style="display: flex; justify-content: space-between; align-items: center;">
                    <div>
                      <p style="font-weight: 500; color: #4a4a4a;">System Notifications</p>
                      <p style="font-size: 14px; color: #6e6e6e; margin-top: 4px;">Important system updates and maintenance alerts</p>
                    </div>
                    <label class="switch">
                      <input type="checkbox" checked>
                      <span class="slider"></span>
                    </label>
                  </div>
                </div>
                <button class="btn btn-primary" style="margin-top: 32px;">Save Preferences</button>
              </div>
              
              <div id="security-tab" class="tab-pane hidden">
                <h3 style="font-size: 18px; font-weight: 600; margin-bottom: 24px;">Security Settings</h3>
                <div style="display: flex; flex-direction: column; gap: 24px;">
                  <div style="display: flex; justify-content: space-between; align-items: center;">
                    <div>
                      <p style="font-weight: 500; color: #4a4a4a;">Two-Factor Authentication</p>
                      <p style="font-size: 14px; color: #6e6e6e; margin-top: 4px;">Add an extra layer of security to your account</p>
                    </div>
                    <button class="btn btn-secondary">Enable</button>
                  </div>
                  <div style="display: flex; justify-content: space-between; align-items: center;">
                    <div>
                      <p style="font-weight: 500; color: #4a4a4a;">Login History</p>
                      <p style="font-size: 14px; color: #6e6e6e; margin-top: 4px;">View your recent login activities</p>
                    </div>
                    <button class="btn btn-secondary">View</button>
                  </div>
                  <div style="display: flex; justify-content: space-between; align-items: center;">
                    <div>
                      <p style="font-weight: 500; color: #4a4a4a;">Session Timeout</p>
                      <p style="font-size: 14px; color: #6e6e6e; margin-top: 4px;">Automatically log out after a period of inactivity</p>
                    </div>
                    <select class="form-select" style="width: 150px;">
                      <option value="15">15 minutes</option>
                      <option value="30" selected>30 minutes</option>
                      <option value="60">1 hour</option>
                      <option value="120">2 hours</option>
                    </select>
                  </div>
                </div>
                <button class="btn btn-primary" style="margin-top: 32px;">Save Settings</button>
              </div>
            </div>
          </div>
        `;
        
        // Setup tab switching
        setTimeout(() => {
          document.querySelectorAll('.tab-btn').forEach(btn => {
            btn.addEventListener('click', (e) => {
              document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
              document.querySelectorAll('.tab-pane').forEach(p => p.classList.add('hidden'));
              
              e.currentTarget.classList.add('active');
              const tabId = e.currentTarget.dataset.tab;
              document.getElementById(`${tabId}-tab`).classList.remove('hidden');
            });
          });
        }, 100);
      }
    };

    // Initialize app
    app.init();

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
  </script>

  <style>
    /* Toggle Switch Styles */
    .switch {
      position: relative;
      display: inline-block;
      width: 44px;
      height: 24px;
    }

    .switch input {
      opacity: 0;
      width: 0;
      height: 0;
    }

    .slider {
      position: absolute;
      cursor: pointer;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background-color: #e0e0e0;
      transition: 0.3s;
      border-radius: 24px;
    }

    .slider:before {
      position: absolute;
      content: "";
      height: 18px;
      width: 18px;
      left: 3px;
      bottom: 3px;
      background-color: white;
      transition: 0.3s;
      border-radius: 50%;
    }

    input:checked + .slider {
      background-color: #1a3e6c;
    }

    input:checked + .slider:before {
      transform: translateX(20px);
    }

    .tab-pane {
      padding-top: 24px;
    }
  </style>
</body>
</html>