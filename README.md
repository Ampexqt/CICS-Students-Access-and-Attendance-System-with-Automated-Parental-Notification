# CICS Students Access and Attendance System with Automated Parental Notification

A comprehensive web-based attendance management system designed for the College of Information and Computing Sciences (CICS) at Zamboanga Peninsula Polytechnic State University (ZPPSU). This system streamlines student attendance tracking, provides real-time monitoring for instructors and administrators, and ensures parents are automatically informed about their child's attendance.

## 🌟 Features

### Core Functionality
- **GPS-Enabled Attendance Tracking**: Students can only mark attendance when within campus boundaries
- **Multi-Role Access**: Separate interfaces for Dean, Instructors, Students, and Parents
- **Real-Time Monitoring**: Live attendance tracking and status updates
- **Automated Parental Notifications**: Daily email summaries sent to parents
- **Request Management System**: Handle device changes, password resets, and rescheduling requests
- **Comprehensive Reporting**: Exportable attendance reports and analytics

### User Roles & Capabilities

#### 🎓 Dean/Admin
- Manage instructors and students
- Approve/reject various requests (device changes, password resets, rescheduling)
- Configure GPS settings for campus boundaries
- Generate comprehensive attendance reports
- Monitor overall system statistics

#### 👨‍🏫 Instructors
- Start and end class sessions
- Monitor real-time attendance
- View student attendance history
- Submit rescheduling requests
- Access attendance analytics for their classes

#### 🎒 Students
- Mark attendance (time in/out) with GPS verification
- View personal attendance logs
- Submit requests for device changes or password resets
- Track attendance status and patterns

#### 👨‍👩‍👧‍👦 Parents
- Receive automated daily email notifications
- View child's attendance summary
- Monitor attendance trends and patterns

## 🏗️ System Architecture

### Technology Stack
- **Frontend**: HTML5, CSS3, JavaScript (ES6+)
- **Styling**: Tailwind CSS
- **Backend**: PHP
- **Database**: MySQL
- **Web Server**: Apache (WAMP/XAMPP)

### Database Schema
The system uses a comprehensive MySQL database with the following main tables:

- `admin` - Administrator accounts and roles
- `instructor` - Instructor information and schedules
- `student` - Student profiles and device associations
- `parent` - Parent contact information
- `attendance` - Attendance records with timestamps
- `subject` - Course and subject information
- `correctionrequest` - Attendance correction requests
- `devicechangerequest` - Device change requests
- `passwordchangerequest` - Password reset requests
- `reschedulerequest` - Class rescheduling requests
- `gps_setting` - Campus GPS boundaries configuration

## 🚀 Installation & Setup

### Prerequisites
- WAMP/XAMPP server with PHP 8.3+ and MySQL 9.1+
- Web browser with JavaScript enabled
- Node.js and npm (for CSS compilation)

### Installation Steps

1. **Clone the Repository**
   ```bash
   git clone https://github.com/your-repo/cics-attendance-system.git
   cd cics-attendance-system
   ```

2. **Database Setup**
   - Start your WAMP/XAMPP server
   - Open phpMyAdmin (http://localhost/phpmyadmin)
   - Create a new database named `cics_attendance_db`
   - Import the SQL file from `database/cics_attendance_db.sql`

3. **Configuration**
   - Update database connection settings in `config/database.php`
   - Configure other settings in `config/config.php`

4. **Frontend Dependencies**
   ```bash
   npm install
   ```

5. **CSS Compilation**
   ```bash
   # Development mode (with watch)
   npm run dev
   
   # Production build
   npm run build:css
   ```

6. **Access the System**
   - Navigate to `http://localhost/cics-attendance-system/public/`
   - The landing page will be displayed
   - Access the login page at `http://localhost/cics-attendance-system/public/login.php`

## 📁 Project Structure

```
CICS-Students-Access-and-Attendance-System/
├── config/
│   ├── config.php          # Main configuration file
│   └── database.php        # Database connection settings
├── database/
│   └── cics_attendance_db.sql  # Database schema and sample data
├── public/                 # Web root served by Apache (was: frontend/)
│   ├── index.php           # Landing page
│   ├── login.php           # Login interface
│   ├── admin/
│   │   ├── admin.php       # Admin dashboard
│   │   └── modals/         # Modal components
│   │       ├── index.html  # Modal showcase
│   │       ├── modal-base.js
│   │       ├── instructor-modal.js
│   │       ├── student-modal.js
│   │       └── request-modal.js
│   ├── instructor/         # Instructor interface (to be implemented)
│   ├── student/            # Student interface (to be implemented)
│   ├── forms/              # Form components (to be implemented)
│   └── assets/
│       └── css/
│           ├── tailwind.css
│           └── build.css   # Compiled CSS
├── node_modules/          # Node.js dependencies
├── package.json           # Node.js project configuration
├── tailwind.config.js     # Tailwind CSS configuration
├── postcss.config.js      # PostCSS configuration
└── README.md             # This file
```

## 🎨 UI/UX Features

### Design System
- **Color Palette**: University-themed colors (#1a3e6c, #436ea3, #f0c75e)
- **Typography**: Poppins and Montserrat fonts
- **Responsive Design**: Mobile-first approach with Tailwind CSS
- **Component Library**: Reusable modal components with animations

### Modal System
The system includes a sophisticated modal system with:
- Base modal class (`AdminModal`) for reusability
- Specialized modals for different functions:
  - Instructor management (add, edit, delete)
  - Student management (add, edit, delete)
  - Request handling (view, approve, reject)
- Smooth animations and transitions
- Keyboard navigation support (ESC to close)
- Backdrop click to close

## 🔧 Development

### Available Scripts
```bash
# Development mode with file watching
npm run dev

# Build CSS for production
npm run build:css

# Run tests (when implemented)
npm test
```

### Code Organization
- **Modular JavaScript**: Each modal type has its own class
- **Event-driven Architecture**: Clean separation of concerns
- **Responsive Components**: Mobile-friendly design patterns
- **Accessibility**: ARIA labels and keyboard navigation

## 🔐 Security Features

- **Device-based Authentication**: One device per student registration
- **GPS Verification**: Attendance only allowed within campus boundaries
- **Role-based Access Control**: Different permissions for each user type
- **Request Approval Workflow**: All changes require admin approval
- **Secure Password Handling**: Hashed passwords in database

## 📊 Reporting & Analytics

### Available Reports
- Daily attendance summaries
- Weekly attendance trends
- Course-wise attendance rates
- Individual student attendance history
- Export functionality (Excel/CSV)

### Dashboard Features
- Real-time statistics
- Visual charts and graphs
- Attendance rate calculations
- Pending request notifications

## 🚧 Future Enhancements

### Planned Features
- **Mobile Application**: Native iOS/Android apps
- **Biometric Integration**: Fingerprint/facial recognition
- **Advanced Analytics**: Machine learning insights
- **Integration APIs**: Connect with other university systems
- **Multi-language Support**: Localization features

### Technical Improvements
- **RESTful API**: Separate backend API development
- **Real-time Updates**: WebSocket implementation
- **Progressive Web App**: Offline functionality
- **Microservices Architecture**: Scalable backend design

## 🤝 Contributing

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/amazing-feature`)
3. Commit your changes (`git commit -m 'Add some amazing feature'`)
4. Push to the branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request

## 📝 License

This project is licensed under the ISC License - see the [LICENSE](LICENSE) file for details.

## 👥 Support

For support and questions:
- Email: support@zppsu.edu.ph
- Documentation: [Project Wiki](https://github.com/your-repo/cics-attendance-system/wiki)
- Issues: [GitHub Issues](https://github.com/your-repo/cics-attendance-system/issues)

## 🙏 Acknowledgments

- **Zamboanga Peninsula Polytechnic State University** for providing the requirements and support
- **College of Information and Computing Sciences (CICS)** for the academic guidance
- **Open Source Community** for the tools and libraries used in this project

---

**Version**: 1.0.0  
**Last Updated**: January 2025  
**Maintained by**: CICS Development Team
