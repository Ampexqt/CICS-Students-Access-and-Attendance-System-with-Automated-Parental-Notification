<?php
/**
 * Security Configuration
 * Contains security settings and helper functions
 */

// Security headers
function setSecurityHeaders() {
    // Prevent clickjacking
    header('X-Frame-Options: DENY');
    
    // Prevent MIME type sniffing
    header('X-Content-Type-Options: nosniff');
    
    // Enable XSS protection
    header('X-XSS-Protection: 1; mode=block');
    
    // Referrer policy
    header('Referrer-Policy: strict-origin-when-cross-origin');
    
    // Content Security Policy (adjust as needed)
    header("Content-Security-Policy: default-src 'self'; script-src 'self' 'unsafe-inline' https://fonts.googleapis.com; style-src 'self' 'unsafe-inline' https://fonts.googleapis.com; font-src 'self' https://fonts.gstatic.com; img-src 'self' data: https:;");
}

// Password requirements
define('MIN_PASSWORD_LENGTH', 8);
define('PASSWORD_REQUIRE_UPPERCASE', true);
define('PASSWORD_REQUIRE_LOWERCASE', true);
define('PASSWORD_REQUIRE_NUMBERS', true);
define('PASSWORD_REQUIRE_SPECIAL', false);

/**
 * Validate password strength
 * @param string $password
 * @return array ['valid' => bool, 'errors' => array]
 */
function validatePasswordStrength($password) {
    $errors = [];
    
    if (strlen($password) < MIN_PASSWORD_LENGTH) {
        $errors[] = 'Password must be at least ' . MIN_PASSWORD_LENGTH . ' characters long';
    }
    
    if (PASSWORD_REQUIRE_UPPERCASE && !preg_match('/[A-Z]/', $password)) {
        $errors[] = 'Password must contain at least one uppercase letter';
    }
    
    if (PASSWORD_REQUIRE_LOWERCASE && !preg_match('/[a-z]/', $password)) {
        $errors[] = 'Password must contain at least one lowercase letter';
    }
    
    if (PASSWORD_REQUIRE_NUMBERS && !preg_match('/[0-9]/', $password)) {
        $errors[] = 'Password must contain at least one number';
    }
    
    if (PASSWORD_REQUIRE_SPECIAL && !preg_match('/[^A-Za-z0-9]/', $password)) {
        $errors[] = 'Password must contain at least one special character';
    }
    
    return [
        'valid' => empty($errors),
        'errors' => $errors
    ];
}

/**
 * Hash password securely
 * @param string $password
 * @return string
 */
function hashPassword($password) {
    return password_hash($password, PASSWORD_DEFAULT);
}

/**
 * Sanitize input data
 * @param mixed $data
 * @return mixed
 */
function sanitizeInput($data) {
    if (is_array($data)) {
        return array_map('sanitizeInput', $data);
    }
    
    return htmlspecialchars(strip_tags(trim($data)), ENT_QUOTES, 'UTF-8');
}

/**
 * Generate secure random token
 * @param int $length
 * @return string
 */
function generateSecureToken($length = 32) {
    return bin2hex(random_bytes($length));
}

/**
 * Check if request is from HTTPS
 * @return bool
 */
function isHTTPS() {
    return isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off';
}

/**
 * Force HTTPS redirect (uncomment in production)
 */
function forceHTTPS() {
    if (!isHTTPS() && !isset($_SERVER['HTTP_X_FORWARDED_PROTO'])) {
        $redirectURL = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        header("Location: $redirectURL");
        exit();
    }
}

/**
 * Rate limiting configuration
 */
define('RATE_LIMIT_LOGIN_ATTEMPTS', 5);
define('RATE_LIMIT_WINDOW', 900); // 15 minutes

/**
 * Check rate limiting for specific action
 * @param string $action
 * @param string $identifier (IP, user ID, etc.)
 * @param int $max_attempts
 * @param int $window_seconds
 * @return bool true if allowed, false if rate limited
 */
function checkRateLimit($action, $identifier, $max_attempts = null, $window_seconds = null) {
    $max_attempts = $max_attempts ?? RATE_LIMIT_LOGIN_ATTEMPTS;
    $window_seconds = $window_seconds ?? RATE_LIMIT_WINDOW;
    
    $key = $action . '_' . md5($identifier);
    $file = sys_get_temp_dir() . '/' . $key;
    
    if (!file_exists($file)) {
        return true;
    }
    
    $attempts = json_decode(file_get_contents($file), true);
    if (!is_array($attempts)) {
        return true;
    }
    
    $current_time = time();
    
    // Clean old attempts
    $attempts = array_filter($attempts, function($timestamp) use ($current_time, $window_seconds) {
        return ($current_time - $timestamp) < $window_seconds;
    });
    
    // Update file with cleaned attempts
    file_put_contents($file, json_encode($attempts));
    
    return count($attempts) < $max_attempts;
}

/**
 * Log rate limit attempt
 * @param string $action
 * @param string $identifier
 */
function logRateLimitAttempt($action, $identifier) {
    $key = $action . '_' . md5($identifier);
    $file = sys_get_temp_dir() . '/' . $key;
    
    $attempts = [];
    if (file_exists($file)) {
        $attempts = json_decode(file_get_contents($file), true);
        if (!is_array($attempts)) {
            $attempts = [];
        }
    }
    
    $attempts[] = time();
    file_put_contents($file, json_encode($attempts));
}

/**
 * Clear rate limit for identifier
 * @param string $action
 * @param string $identifier
 */
function clearRateLimit($action, $identifier) {
    $key = $action . '_' . md5($identifier);
    $file = sys_get_temp_dir() . '/' . $key;
    
    if (file_exists($file)) {
        unlink($file);
    }
}

// Set security headers automatically when this file is included
setSecurityHeaders();
?>
