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
    const requestsToggle = document.getElementById('requests-toggle');
    requestsToggle.addEventListener('click', (e) => {
      e.preventDefault();
      const submenu = document.getElementById('requests-submenu');
      submenu.classList.toggle('open');
      requestsToggle.classList.toggle('open');
    });

    this.setupMobileMenu();
  },

  setupMobileMenu() {
    const mobileMenuToggle = document.getElementById('mobileMenuToggle');
    const mobileMenu = document.getElementById('mobileMenu');
    const mobileMenuClose = document.getElementById('mobileMenuClose');
    const mobileMenuBackdrop = document.getElementById('mobileMenuBackdrop');
    const mobileRequestsToggle = document.getElementById('mobileRequestsToggle');
    const mobileRequestsSubmenu = document.getElementById('mobileRequestsSubmenu');

    mobileMenuToggle.addEventListener('click', () => {
      mobileMenu.classList.add('open');
      document.body.style.overflow = 'hidden';
    });

    const closeMobileMenu = () => {
      mobileMenu.classList.remove('open');
      document.body.style.overflow = '';
    };

    mobileMenuClose.addEventListener('click', closeMobileMenu);
    mobileMenuBackdrop.addEventListener('click', closeMobileMenu);

    mobileRequestsToggle.addEventListener('click', (e) => {
      e.preventDefault();
      mobileRequestsToggle.classList.toggle('open');
      mobileRequestsSubmenu.classList.toggle('open');
    });

    document.querySelectorAll('.mobile-nav-item[data-route]').forEach(item => {
      item.addEventListener('click', () => {
        closeMobileMenu();
      });
    });

    document.addEventListener('keydown', (e) => {
      if (e.key === 'Escape' && mobileMenu.classList.contains('open')) {
        closeMobileMenu();
      }
    });
  },
  
  handleRoute() {
    const hash = window.location.hash.slice(1) || '/';
    const route = this.routes[hash] || this.routes['/'];
    
    document.querySelectorAll('.nav-link, .mobile-nav-item').forEach(link => {
      link.classList.remove('active');
      if (link.dataset.route === hash) {
        link.classList.add('active');
      }
    });
    
    if (hash.includes('/requests')) {
      document.getElementById('requests-submenu').classList.add('open');
      document.getElementById('requests-toggle').classList.add('open');
      const mobileRequestsSubmenu = document.getElementById('mobileRequestsSubmenu');
      const mobileRequestsToggle = document.getElementById('mobileRequestsToggle');
      if (mobileRequestsSubmenu && mobileRequestsToggle) {
        mobileRequestsSubmenu.classList.add('open');
        mobileRequestsToggle.classList.add('open');
      }
    } else {
      document.getElementById('requests-submenu').classList.remove('open');
      document.getElementById('requests-toggle').classList.remove('open');
      const mobileRequestsSubmenu = document.getElementById('mobileRequestsSubmenu');
      const mobileRequestsToggle = document.getElementById('mobileRequestsToggle');
      if (mobileRequestsSubmenu && mobileRequestsToggle) {
        mobileRequestsSubmenu.classList.remove('open');
        mobileRequestsToggle.classList.remove('open');
      }
    }
    
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
    
    route();
  }
};

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
    `;
  },

  async instructors() {
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
            <input type="text" class="search-input" placeholder="Search instructors..." onkeyup="filterInstructors(this.value)">
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
                <th>Schedule</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody id="instructors-table-body">
              <tr>
                <td colspan="6" style="text-align: center; padding: 20px;">Loading...</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    `;
    await loadInstructors();
  },

  students() {
    document.getElementById('app').innerHTML = `<h1>Students Page</h1>`;
  },

  correctionRequests() {
    document.getElementById('app').innerHTML = `<h1>Correction Requests</h1>`;
  },

  deviceRequests() {
    document.getElementById('app').innerHTML = `<h1>Device Requests</h1>`;
  },

  passwordRequests() {
    document.getElementById('app').innerHTML = `<h1>Password Requests</h1>`;
  },

  rescheduleRequests() {
    document.getElementById('app').innerHTML = `<h1>Reschedule Requests</h1>`;
  },

  reports() {
    document.getElementById('app').innerHTML = `<h1>Reports</h1>`;
  },

  gps() {
    document.getElementById('app').innerHTML = `<h1>GPS Settings</h1>`;
  },

  settings() {
    document.getElementById('app').innerHTML = `<h1>Account Settings</h1>`;
  }
};

// CRUD Functions for Instructors
async function loadInstructors() {
  try {
    const basePath = window.location.pathname.split('/pages/')[0] || '';
    const response = await fetch(`${basePath}/pages/admin/api/instructors/list.php`);
    const data = await response.json();
    
    if (data.success) {
      renderInstructorsTable(data.data);
    } else {
      showToast('Failed to load instructors: ' + data.message, 'error');
    }
  } catch (error) {
    console.error('Error loading instructors:', error);
    showToast('Error loading instructors', 'error');
  }
}

function renderInstructorsTable(instructors) {
  const tbody = document.getElementById('instructors-table-body');
  if (!tbody) return;
  
  if (instructors.length === 0) {
    tbody.innerHTML = `
      <tr>
        <td colspan="6" style="text-align: center; padding: 20px; color: #666;">
          No instructors found. Click "Add Instructor" to create one.
        </td>
      </tr>
    `;
    return;
  }
  
  tbody.innerHTML = instructors.map(instructor => `
    <tr>
      <td>${instructor.first_name} ${instructor.last_name}</td>
      <td>${instructor.email}</td>
      <td>${instructor.assigned_subject || '-'}</td>
      <td>${instructor.section_handled || '-'}</td>
      <td>${instructor.schedule_day && instructor.schedule_time ? instructor.schedule_day + ' ' + instructor.schedule_time : '-'}</td>
      <td class="action-icons">
        <button class="icon-btn" title="Edit" onclick="showEditInstructorModal(${instructor.instructor_id})">
          <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
          </svg>
        </button>
        <button class="icon-btn delete" title="Delete" onclick="confirmDeleteInstructor(${instructor.instructor_id}, '${instructor.first_name} ${instructor.last_name}')">
          <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
          </svg>
        </button>
      </td>
    </tr>
  `).join('');
}

function filterInstructors(searchTerm) {
  const rows = document.querySelectorAll('#instructors-table-body tr');
  rows.forEach(row => {
    const text = row.textContent.toLowerCase();
    row.style.display = text.includes(searchTerm.toLowerCase()) ? '' : 'none';
  });
}

async function confirmDeleteInstructor(instructorId, instructorName) {
  if (!confirm('Are you sure you want to delete instructor "' + instructorName + '"?')) {
    return;
  }
  
  try {
    const basePath = window.location.pathname.split('/pages/')[0] || '';
    const response = await fetch(basePath + '/pages/admin/api/instructors/delete.php', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({ instructor_id: instructorId })
    });
    
    const data = await response.json();
    if (data.success) {
      showToast('Instructor deleted successfully', 'success');
      loadInstructors();
    } else {
      showToast('Failed to delete instructor: ' + data.message, 'error');
    }
  } catch (error) {
    console.error('Error deleting instructor:', error);
    showToast('Error deleting instructor', 'error');
  }
}

// Toast helpers
function injectToastStylesOnce() {
  if (document.getElementById('toast-styles')) return;
  const style = document.createElement('style');
  style.id = 'toast-styles';
  style.textContent = `
    #toast-container { position: fixed; top: 16px; right: 16px; z-index: 9999; display: flex; flex-direction: column; gap: 8px; }
    .toast { min-width: 240px; max-width: 360px; padding: 12px 14px; border-radius: 8px; color: #fff; font-family: Arial, Helvetica, sans-serif; font-size: 14px; box-shadow: 0 6px 18px rgba(0,0,0,0.18); opacity: 0; transform: translateY(-6px); transition: all .25s ease; }
    .toast.show { opacity: 1; transform: translateY(0); }
    .toast-success { background: #16a34a; }
    .toast-error { background: #dc2626; }
    .toast-info { background: #2563eb; }
  `;
  document.head.appendChild(style);
}

function showToast(message, type, duration) {
  type = type || 'info';
  duration = duration || 4000;
  injectToastStylesOnce();
  let container = document.getElementById('toast-container');
  if (!container) {
    container = document.createElement('div');
    container.id = 'toast-container';
    document.body.appendChild(container);
  }
  const toast = document.createElement('div');
  toast.className = 'toast toast-' + type;
  toast.textContent = message;
  container.appendChild(toast);
  requestAnimationFrame(() => toast.classList.add('show'));
  setTimeout(() => {
    toast.classList.remove('show');
    setTimeout(() => toast.remove(), 250);
  }, duration);
}

// Global functions
function showAddInstructorModal() {
  const modal = document.createElement('div');
  modal.className = 'modal';
  modal.innerHTML = `
    <div class="modal-content">
      <h3 class="modal-header">Add New Instructor</h3>
      <form id="add-instructor-form">
        <div class="grid grid-cols-2" style="gap: 16px;">
          <div class="form-group">
            <label class="form-label">First Name</label>
            <input type="text" class="form-input" name="first_name" required>
          </div>
          <div class="form-group">
            <label class="form-label">Last Name</label>
            <input type="text" class="form-input" name="last_name" required>
          </div>
        </div>
        <div class="form-group">
          <label class="form-label">Email</label>
          <input type="email" class="form-input" name="email" required>
        </div>
        <div class="form-group">
          <label class="form-label">Subject</label>
          <input type="text" class="form-input" name="subject">
        </div>
        <div class="form-group">
          <label class="form-label">Section</label>
          <input type="text" class="form-input" name="section">
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

  const form = modal.querySelector('#add-instructor-form');
  form.addEventListener('submit', async (e) => {
    e.preventDefault();
    const formData = new FormData(form);
    const payload = Object.fromEntries(formData.entries());

    if (!payload.first_name || !payload.last_name || !payload.email) {
      alert('Please fill in First Name, Last Name, and Email.');
      return;
    }

    try {
      const basePath = window.location.pathname.split('/pages/')[0] || '';
      const endpoint = basePath + '/modules/instructors/create.php';
      const res = await fetch(endpoint, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(payload)
      });
      const data = await res.json().catch(() => ({}));
      if (!res.ok || !data.success) {
        showToast(data.message || 'Failed to create instructor.', 'error');
        return;
      }
      if (window.emailjs && typeof emailjs.send === 'function') {
        console.log('EmailJS is available. Preparing to send...');
        const templateParams = {
          email: payload.email,
          instructor_name: (payload.first_name + ' ' + payload.last_name).trim(),
          temp_password: data.temp_password || '',
          portal_url: window.location.origin + basePath + '/index.php',
          org_name: 'CICS Attendance System',
          support_email: 'haroldzkie99@gmail.com',
          logo_url: window.location.origin + basePath + '/assets/logo/cics_logo.png',
          year: new Date().getFullYear().toString()
        };
        try {
          console.log('EmailJS send payload:', { service: 'service_1u6kzup', template: 'template_bgrl80h', templateParams });
          const result = await emailjs.send('service_1u6kzup', 'template_bgrl80h', templateParams);
          console.log('EmailJS sent successfully:', result);
          showToast('Email sent to ' + payload.email, 'success');
        } catch (e) {
          console.error('EmailJS send failed - Full error:', e);
          console.error('Error status:', e.status);
          console.error('Error text:', e.text);
          if (e.status === 400) {
            console.error('400 Error - likely template variable mismatch or validation issue');
          }
          showToast('Email failed: ' + (e.text || e.message || 'Unknown error'), 'error');
        }
      } else {
        console.warn('EmailJS not available at send time', { emailjs: window.emailjs });
        showToast('EmailJS not available. Email not sent.', 'error');
      }
      showToast('Instructor created. Temp password: ' + (data.temp_password || '(generated)'), 'success');
      modal.remove();
      if (window.location.hash === '#/instructors') {
        loadInstructors();
      }
    } catch (err) {
      showToast('Network error while creating instructor.', 'error');
      console.error(err);
    }
  });
}

function showLogoutModal() {
  alert('Logout functionality not implemented yet.');
}

function confirmLogout() {
  alert('You have been logged out successfully.');
}

// Initialize app
app.init();
