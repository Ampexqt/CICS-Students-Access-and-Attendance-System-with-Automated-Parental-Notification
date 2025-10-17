<?php
/**
 * Authentication Middleware
 * Handles session validation and user authentication checks
 */

// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start([
        'cookie_lifetime' => 3600, // 1 hour
        'cookie_secure' => isset($_SERVER['HTTPS']),
        'cookie_httponly' => true,
        'cookie_samesite' => 'Strict'
    ]);
}

/**
 * Check if user is authenticated
 * @return bool
 */
function isAuthenticated() {
    return isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] === true;
}

/**
 * Check if session is still valid (not expired)
 * @return bool
 */
function isSessionValid() {
    if (!isset($_SESSION['last_activity'])) {
        return false;
    }
    
    // Session timeout: 1 hour of inactivity
    $timeout = 3600; // 1 hour
    if (time() - $_SESSION['last_activity'] > $timeout) {
        return false;
    }
    
    return true;
}

/**
 * Update last activity timestamp
 */
function updateLastActivity() {
    $_SESSION['last_activity'] = time();
}

/**
 * Check if user has specific role
 * @param string $role
 * @return bool
 */
function hasRole($role) {
    if (!isAuthenticated()) {
        return false;
    }
    
    $userRole = $_SESSION['role'] ?? '';
    return strtolower($userRole) === strtolower($role);
}

/**
 * Check if user is of specific type
 * @param string $type
 * @return bool
 */
function isUserType($type) {
    if (!isAuthenticated()) {
        return false;
    }
    
    $userType = $_SESSION['user_type'] ?? '';
    return strtolower($userType) === strtolower($type);
}

/**
 * Require authentication - redirect to login if not authenticated
 * @param string $redirect_url Optional URL to redirect to after login
 */
function requireAuth($redirect_url = null) {
    if (!isAuthenticated() || !isSessionValid()) {
        // Destroy invalid session
        session_destroy();
        
        // Prepare redirect URL
        $login_url = '/login.php';
        if ($redirect_url) {
            $login_url .= '?redirect=' . urlencode($redirect_url);
        }
        
        // Redirect to login
        header('Location: ' . $login_url);
        exit;
    }
    
    // Update last activity
    updateLastActivity();
}

/**
 * Require specific role - redirect with error if user doesn't have role
 * @param string $required_role
 * @param string $error_message
 */
function requireRole($required_role, $error_message = 'Access denied. Insufficient permissions.') {
    requireAuth();
    
    if (!hasRole($required_role)) {
        // Log unauthorized access attempt
        error_log("Unauthorized access attempt by user ID: " . ($_SESSION['user_id'] ?? 'unknown') . 
                 " to role-restricted area requiring: " . $required_role);
        
        http_response_code(403);
        die($error_message);
    }
}

/**
 * Require specific user type - redirect with error if user is not of specified type
 * @param string $required_type
 * @param string $error_message
 */
function requireUserType($required_type, $error_message = 'Access denied. This area is restricted.') {
    requireAuth();
    
    if (!isUserType($required_type)) {
        // Log unauthorized access attempt
        error_log("Unauthorized access attempt by user ID: " . ($_SESSION['user_id'] ?? 'unknown') . 
                 " to type-restricted area requiring: " . $required_type);
        
        http_response_code(403);
        die($error_message);
    }
}

/**
 * Get current user information
 * @return array|null
 */
function getCurrentUser() {
    if (!isAuthenticated()) {
        return null;
    }
    
    return [
        'id' => $_SESSION['user_id'] ?? null,
        'type' => $_SESSION['user_type'] ?? null,
        'email' => $_SESSION['email'] ?? null,
        'first_name' => $_SESSION['first_name'] ?? null,
        'last_name' => $_SESSION['last_name'] ?? null,
        'role' => $_SESSION['role'] ?? null,
        'full_name' => trim(($_SESSION['first_name'] ?? '') . ' ' . ($_SESSION['last_name'] ?? '')),
        'login_time' => $_SESSION['login_time'] ?? null,
        'last_activity' => $_SESSION['last_activity'] ?? null
    ];
}

/**
 * Logout user and destroy session
 */
function logout() {
    // Clear all session variables
    $_SESSION = array();
    
    // Delete the session cookie
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
            $params["path"], $params["domain"],
            $params["secure"], $params["httponly"]
        );
    }
    
    // Destroy the session
    session_destroy();
}

/**
 * Generate CSRF token
 * @return string
 */
function generateCSRFToken() {
    if (!isset($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

/**
 * Verify CSRF token
 * @param string $token
 * @return bool
 */
function verifyCSRFToken($token) {
    return isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token);
}

/**
 * Get user's dashboard URL based on their type
 * @return string
 */
function getUserDashboardUrl() {
    if (!isAuthenticated()) {
        return '/login.php';
    }
    
    $userType = $_SESSION['user_type'] ?? '';
    
    switch (strtolower($userType)) {
        case 'admin':
            return '/pages/admin/dashboard.php';
        case 'instructor':
            return '/pages/intructor/intructor.php';
        case 'student':
            return '/pages/student/student.dashboard.php';
        default:
            return '/login.php';
    }
}
?>
