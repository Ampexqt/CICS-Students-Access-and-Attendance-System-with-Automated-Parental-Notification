// Initialize Lucide icons
lucide.createIcons();

// Set current year in footer
document.getElementById('currentYear').textContent = new Date().getFullYear();

// Sidebar functionality
const sidebar = document.getElementById('sidebar');
const sidebarOverlay = document.getElementById('sidebarOverlay');
const mobileMenuBtn = document.getElementById('mobileMenuBtn');

// Toggle sidebar on mobile
mobileMenuBtn.addEventListener('click', () => {
    sidebar.classList.toggle('open');
    sidebarOverlay.classList.toggle('active');
});

// Close sidebar when clicking overlay
sidebarOverlay.addEventListener('click', () => {
    sidebar.classList.remove('open');
    sidebarOverlay.classList.remove('active');
});

// Handle navigation active states
document.querySelectorAll('.sidebar-nav .nav-link').forEach(link => {
    link.addEventListener('click', (e) => {
        // Remove active class from all links
        document.querySelectorAll('.sidebar-nav .nav-link').forEach(l => l.classList.remove('active'));
        // Add active class to clicked link
        e.currentTarget.classList.add('active');
    });
});

// Attendance session functionality
const startSessionButton = document.getElementById('startSession');
const endSessionButton = document.getElementById('endSession');
const sessionStatus = document.getElementById('sessionStatus');
const sessionProgress = document.getElementById('sessionProgress');
const startTime = document.getElementById('startTime');
const sessionTimer = document.getElementById('sessionTimer');
const presentCount = document.getElementById('presentCount');
const lateCount = document.getElementById('lateCount');
const absentCount = document.getElementById('absentCount');

let sessionInterval;
let sessionSeconds = 0;

if (startSessionButton) {
    startSessionButton.addEventListener('click', () => {
        // Update UI
        startSessionButton.classList.add('hidden');
        endSessionButton.classList.remove('hidden');
        sessionStatus.innerHTML = '<span class="status-indicator active"></span>Active';
        sessionProgress.classList.remove('hidden');
        
        // Set start time
        const now = new Date();
        const hours = now.getHours();
        const minutes = now.getMinutes();
        const ampm = hours >= 12 ? 'PM' : 'AM';
        const formattedHours = hours % 12 || 12;
        const formattedMinutes = minutes < 10 ? '0' + minutes : minutes;
        startTime.textContent = `Started at ${formattedHours}:${formattedMinutes} ${ampm}`;
        
        // Start timer
        sessionSeconds = 0;
        updateTimer();
        sessionInterval = setInterval(updateTimer, 1000);
        
        // Simulate attendance counts
        simulateAttendanceCounts();
    });
}

if (endSessionButton) {
    endSessionButton.addEventListener('click', () => {
        // Update UI
        endSessionButton.classList.add('hidden');
        startSessionButton.classList.remove('hidden');
        sessionStatus.innerHTML = '<span class="status-indicator inactive"></span>Inactive';
        sessionProgress.classList.add('hidden');
        
        // Stop timer
        clearInterval(sessionInterval);
        
        // Reset counts
        presentCount.textContent = '0';
        lateCount.textContent = '0';
        absentCount.textContent = '0';
    });
}

function updateTimer() {
    sessionSeconds++;
    const hours = Math.floor(sessionSeconds / 3600);
    const minutes = Math.floor((sessionSeconds % 3600) / 60);
    const seconds = sessionSeconds % 60;
    
    const formattedHours = hours.toString().padStart(2, '0');
    const formattedMinutes = minutes.toString().padStart(2, '0');
    const formattedSeconds = seconds.toString().padStart(2, '0');
    
    if (sessionTimer) {
        sessionTimer.textContent = `${formattedHours}:${formattedMinutes}:${formattedSeconds}`;
    }
}

function simulateAttendanceCounts() {
    // Simulate real-time attendance updates
    let present = 0;
    let late = 0;
    let absent = 0;
    
    const updateCounts = setInterval(() => {
        if (!sessionInterval) {
            clearInterval(updateCounts);
            return;
        }
        
        // Randomly update counts to simulate real attendance
        if (Math.random() < 0.3) {
            present += Math.floor(Math.random() * 2);
            presentCount.textContent = present;
        }
        
        if (Math.random() < 0.1) {
            late += Math.floor(Math.random() * 1);
            lateCount.textContent = late;
        }
        
        if (Math.random() < 0.05) {
            absent += Math.floor(Math.random() * 1);
            absentCount.textContent = absent;
        }
    }, 3000);
}

// Calendar navigation
const prevMonthButton = document.getElementById('prevMonth');
const nextMonthButton = document.getElementById('nextMonth');
const currentMonthElement = document.getElementById('currentMonth');

let currentDate = new Date();

function updateCalendarDisplay() {
    if (currentMonthElement) {
        currentMonthElement.textContent = currentDate.toLocaleString('default', {
            month: 'long',
            year: 'numeric'
        });
    }
}

if (prevMonthButton) {
    prevMonthButton.addEventListener('click', () => {
        currentDate.setMonth(currentDate.getMonth() - 1);
        updateCalendarDisplay();
    });
}

if (nextMonthButton) {
    nextMonthButton.addEventListener('click', () => {
        currentDate.setMonth(currentDate.getMonth() + 1);
        updateCalendarDisplay();
    });
}

// Initialize calendar display
updateCalendarDisplay();

// Correction request buttons
document.querySelectorAll('.btn-success').forEach(button => {
    button.addEventListener('click', function(e) {
        e.preventDefault();
        const requestItem = this.closest('.request-item');
        const statusSpan = requestItem.querySelector('.request-status');
        statusSpan.textContent = 'Approved';
        statusSpan.className = 'request-status approved';
        statusSpan.style.backgroundColor = 'rgba(22, 163, 74, 0.1)';
        statusSpan.style.color = '#16a34a';
        this.closest('.request-actions').remove();
    });
});

document.querySelectorAll('.btn-danger').forEach(button => {
    button.addEventListener('click', function(e) {
        e.preventDefault();
        const requestItem = this.closest('.request-item');
        const statusSpan = requestItem.querySelector('.request-status');
        statusSpan.textContent = 'Rejected';
        statusSpan.className = 'request-status rejected';
        statusSpan.style.backgroundColor = 'rgba(239, 68, 68, 0.1)';
        statusSpan.style.color = '#ef4444';
        this.closest('.request-actions').remove();
    });
});

// Handle window resize for responsive sidebar
window.addEventListener('resize', () => {
    if (window.innerWidth >= 768) {
        sidebar.classList.remove('open');
        sidebarOverlay.classList.remove('active');
    }
});

// Initialize page
document.addEventListener('DOMContentLoaded', () => {
    // Re-initialize Lucide icons after dynamic content changes
    lucide.createIcons();
});