# CICS Attendance System - Secure Login Documentation

## Overview
This document describes the secure login system implemented for the CICS Students Access and Attendance System. The system supports three user types with role-based authentication and redirection.

## User Types & Database Structure

### 1. Admin Users
- **Table**: `admin`
- **Primary Key**: `admin_id`
- **Login Field**: `email`
- **Dashboard**: `pages/admin/dashboard.php`
- **Role**: Dean (default)

### 2. Instructor Users
- **Table**: `instructor` 
- **Primary Key**: `instructor_id`
- **Login Field**: `email`
- **Dashboard**: `pages/intructor/intructor.php`
- **Role**: Instructor

### 3. Student Users
- **Table**: `student`
- **Primary Key**: `student_id`
- **Login Fields**: `email` OR `student_id` (numeric)
- **Dashboard**: `pages/student/student.dashboard.php`
- **Role**: Student
- **Status**: Must be 'active' to login

## Security Features

### 1. Password Security
- Passwords are hashed using PHP's `password_hash()` with `PASSWORD_DEFAULT`
- Passwords are verified using `password_verify()`
- Minimum password length: 6 characters (configurable)

### 2. Session Security
- Secure session configuration:
  - `cookie_lifetime`: 3600 seconds (1 hour)
  - `cookie_secure`: True for HTTPS
  - `cookie_httponly`: True (prevents XSS)
  - `cookie_samesite`: 'Strict' (prevents CSRF)
- Session ID regeneration on successful login
- Session timeout: 1 hour of inactivity

### 3. Rate Limiting
- Maximum 5 failed login attempts per IP address
- 15-minute lockout window
- Automatic cleanup of old attempts
- Rate limit cleared on successful login

### 4. Input Validation & Sanitization
- Email/Student ID input sanitized using `htmlspecialchars()`
- Password minimum length validation
- Empty field validation
- SQL injection prevention using prepared statements

### 5. Security Headers
- `X-Frame-Options: DENY` (prevents clickjacking)
- `X-Content-Type-Options: nosniff` (prevents MIME sniffing)
- `X-XSS-Protection: 1; mode=block` (XSS protection)
- `Referrer-Policy: strict-origin-when-cross-origin`
- Content Security Policy (CSP) configured

### 6. Error Handling
- Generic error messages to prevent information disclosure
- Detailed logging for debugging (server-side only)
- Proper HTTP status codes
- No database error exposure to users

## File Structure

```
├── login.php                          # Login form (existing)
├── login_process.php                  # Secure login handler (updated)
├── logout.php                         # Logout handler (new)
├── config/
│   ├── db.php                         # Database configuration (existing)
│   └── security.php                   # Security configuration (new)
├── middleware/
│   └── auth.php                       # Authentication middleware (new)
├── utils/
│   └── hash_password.php              # Password hashing utility (new)
└── database/
    └── test_login_data.sql             # Test data for login system (new)
```

## Usage Examples

### 1. Protecting Pages with Authentication
```php
<?php
require_once '../middleware/auth.php';

// Require any authenticated user
requireAuth();

// Require specific user type
requireUserType('admin');

// Require specific role
requireRole('Dean');

// Get current user info
$user = getCurrentUser();
echo "Welcome, " . $user['full_name'];
?>
```

### 2. Role-Based Content Display
```php
<?php
require_once '../middleware/auth.php';
requireAuth();

if (isUserType('admin')) {
    echo "Admin-only content";
} elseif (isUserType('instructor')) {
    echo "Instructor-only content";
} elseif (isUserType('student')) {
    echo "Student-only content";
}
?>
```

### 3. CSRF Protection
```php
<?php
require_once '../middleware/auth.php';

// Generate token for forms
$csrf_token = generateCSRFToken();

// In form:
echo '<input type="hidden" name="csrf_token" value="' . $csrf_token . '">';

// Verify token on submission
if (!verifyCSRFToken($_POST['csrf_token'])) {
    die('CSRF token validation failed');
}
?>
```

## Login Flow

1. **User submits credentials** via AJAX from `login.php`
2. **Rate limiting check** - Block if too many attempts
3. **Input validation** - Sanitize and validate inputs
4. **Database authentication**:
   - Check `admin` table first
   - Then `instructor` table
   - Finally `student` table (by email or student_id)
5. **Password verification** using `password_verify()`
6. **Session creation** with secure settings
7. **Role-based redirection** to appropriate dashboard
8. **Rate limit cleanup** on successful login

## Test Credentials

Use the following test accounts (after running `test_login_data.sql`):

| Type | Email/ID | Password | Redirects To |
|------|----------|----------|--------------|
| Admin | admin@zppsu.edu.ph | password | pages/admin/dashboard.php |
| Instructor | instructor@zppsu.edu.ph | password | pages/intructor/intructor.php |
| Student | student@zppsu.edu.ph | password | pages/student/student.dashboard.php |
| Student | 2 (student_id) | password | pages/student/student.dashboard.php |

## Configuration

### Security Settings (config/security.php)
```php
define('MIN_PASSWORD_LENGTH', 8);
define('PASSWORD_REQUIRE_UPPERCASE', true);
define('PASSWORD_REQUIRE_LOWERCASE', true);
define('PASSWORD_REQUIRE_NUMBERS', true);
define('PASSWORD_REQUIRE_SPECIAL', false);
define('RATE_LIMIT_LOGIN_ATTEMPTS', 5);
define('RATE_LIMIT_WINDOW', 900); // 15 minutes
```

### Session Settings
```php
session_start([
    'cookie_lifetime' => 3600,
    'cookie_secure' => isset($_SERVER['HTTPS']),
    'cookie_httponly' => true,
    'cookie_samesite' => 'Strict'
]);
```

## Security Recommendations

1. **HTTPS**: Always use HTTPS in production
2. **Password Policy**: Enforce strong passwords for all users
3. **Regular Updates**: Keep PHP and database updated
4. **Monitoring**: Monitor failed login attempts
5. **Backup**: Regular database backups
6. **Audit**: Regular security audits
7. **2FA**: Consider implementing two-factor authentication

## Troubleshooting

### Common Issues

1. **"Too many login attempts"**
   - Wait 15 minutes or clear rate limit files in temp directory

2. **"Invalid credentials"**
   - Verify user exists in correct table
   - Check password hash in database
   - Ensure student status is 'active'

3. **Session timeout**
   - Sessions expire after 1 hour of inactivity
   - User must login again

4. **Redirect issues**
   - Verify dashboard files exist at specified paths
   - Check file permissions

### Debug Mode
To enable debug logging, add to your PHP configuration:
```php
error_reporting(E_ALL);
log_errors = 1;
error_log = /path/to/error.log
```

## Maintenance

### Regular Tasks
1. Clean up rate limit files in temp directory
2. Monitor error logs for security issues
3. Update password hashes if needed
4. Review and rotate session secrets
5. Update security headers as needed

### Password Updates
Use `utils/hash_password.php` to generate new password hashes:
```bash
php utils/hash_password.php "newpassword"
```

## Compliance
This implementation follows:
- OWASP security guidelines
- PHP security best practices
- Modern authentication standards
- Session management best practices
