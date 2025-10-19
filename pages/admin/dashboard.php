<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CICS Attendance System</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
  <link rel="stylesheet" href="dashboard.css">
</head>
<body>
  <!-- Sidebar -->
  <div class="sidebar">
    <div class="sidebar-header">
      <img src="../../assets/logo/cics_logo.png" alt="CICS Logo" class="sidebar-logo">
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
        <a href="#/requests" class="nav-link requests-toggle" data-route="/requests" id="requests-toggle">
          <div class="nav-link-content">
            <svg class="nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
            </svg>
            <span>Requests</span>
          </div>
          <svg class="dropdown-icon" width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
          </svg>
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
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 002 2v6a2 2 0 002 2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
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
    </nav>
    <div class="logout-section">
      <button class="logout-btn" onclick="showLogoutModal()">
        <svg class="nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
        </svg>
        <span>Logout</span>
      </button>
    </div>
  </div>

  <!-- TopBar -->
  <div class="topbar">
    <div class="topbar-left">
      <button class="mobile-menu-toggle" id="mobileMenuToggle" aria-label="Toggle menu">
        <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
        </svg>
      </button>
      <div class="topbar-title" id="page-title">Dashboard</div>
    </div>
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

  <!-- Mobile Menu -->
  <div class="mobile-menu" id="mobileMenu">
    <div class="mobile-menu-backdrop" id="mobileMenuBackdrop"></div>
    <div class="mobile-menu-panel">
      <div class="mobile-menu-header">
        <div class="mobile-logo">
          <img src="../../assets/logo/cics_logo.png" alt="CICS Logo" class="sidebar-logo">
          <h1>CICS Attendance</h1>
        </div>
        <button class="mobile-menu-close" id="mobileMenuClose" aria-label="Close menu">
          <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
          </svg>
        </button>
      </div>
      <nav class="mobile-nav">
        <a href="#/" class="mobile-nav-item" data-route="/">
          <svg class="nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
          </svg>
          <span>Dashboard</span>
        </a>
        <a href="#/instructors" class="mobile-nav-item" data-route="/instructors">
          <svg class="nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
          </svg>
          <span>Manage Instructors</span>
        </a>
        <a href="#/students" class="mobile-nav-item" data-route="/students">
          <svg class="nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
          </svg>
          <span>Manage Students</span>
        </a>
        <div class="mobile-nav-item mobile-requests-toggle" id="mobileRequestsToggle">
          <svg class="nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
          </svg>
          <span>Requests</span>
          <svg class="dropdown-icon" width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
          </svg>
        </div>
        <div class="mobile-submenu" id="mobileRequestsSubmenu">
          <a href="#/requests/correction" class="mobile-nav-item submenu-item" data-route="/requests/correction">
            <span class="submenu-dot"></span>
            <span>Correction Requests</span>
          </a>
          <a href="#/requests/device" class="mobile-nav-item submenu-item" data-route="/requests/device">
            <span class="submenu-dot"></span>
            <span>Device Change Requests</span>
          </a>
          <a href="#/requests/password" class="mobile-nav-item submenu-item" data-route="/requests/password">
            <span class="submenu-dot"></span>
            <span>Password Change Requests</span>
          </a>
          <a href="#/requests/reschedule" class="mobile-nav-item submenu-item" data-route="/requests/reschedule">
            <span class="submenu-dot"></span>
            <span>Reschedule Requests</span>
          </a>
        </div>
        <a href="#/reports" class="mobile-nav-item" data-route="/reports">
          <svg class="nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 002 2v6a2 2 0 002 2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
          </svg>
          <span>Attendance Reports</span>
        </a>
        <a href="#/gps" class="mobile-nav-item" data-route="/gps">
          <svg class="nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
          </svg>
          <span>GPS Settings</span>
        </a>
        <a href="#/settings" class="mobile-nav-item" data-route="/settings">
          <svg class="nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
          </svg>
          <span>Account Settings</span>
        </a>
        <button class="mobile-nav-item logout-item" onclick="showLogoutModal()">
          <svg class="nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
          </svg>
          <span>Logout</span>
        </button>
      </nav>
    </div>
  </div>

  <!-- Main Content -->
  <div class="main-content" id="app"></div>

  <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script>
    // Check if Chart.js loaded successfully
    window.addEventListener('load', function() {
      if (typeof Chart === 'undefined') {
        console.error('Chart.js failed to load from CDN');
        // You could load a local fallback here if needed
      } else {
        console.log('Chart.js loaded successfully, version:', Chart.version);
      }
    });
  </script>
  <script src="https://cdn.jsdelivr.net/npm/@emailjs/browser@3/dist/email.min.js"></script>
  <script>
    (function(){
      if (window.emailjs && typeof emailjs.init === 'function') {
        try {
          emailjs.init('6Ac8NexftXFZrF19D');
          console.log('EmailJS initialized successfully');
        } catch (e) {
          console.error('EmailJS init failed', e);
        }
      } else {
        console.error('EmailJS SDK not loaded');
      }
    })();
  </script>
  <script src="dashboard.js?v=11"></script>
</body>
</html>