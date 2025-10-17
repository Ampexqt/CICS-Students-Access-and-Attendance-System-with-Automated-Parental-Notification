<?php
// Start session with secure settings
session_start([
    'cookie_lifetime' => 3600, // 1 hour
    'cookie_secure' => isset($_SERVER['HTTPS']),
    'cookie_httponly' => true,
    'cookie_samesite' => 'Strict'
]);

// Include database configuration and security
require_once 'config/db.php';
require_once 'config/security.php';

// Set content type to JSON for AJAX responses
header('Content-Type: application/json');

// Check if request method is POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Method not allowed']);
    exit;
}

// Rate limiting check
$ip = $_SERVER['REMOTE_ADDR'] ?? 'unknown';
if (!checkRateLimit('login', $ip)) {
    http_response_code(429);
    echo json_encode(['success' => false, 'message' => 'Too many login attempts. Please try again later.']);
    exit;
}

// Get input data and sanitize
$email = sanitizeInput($_POST['email'] ?? '');
$password = $_POST['password'] ?? ''; // Don't sanitize password as it may contain special chars

// Validate input
if (empty($email) || empty($password)) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Email/Student ID and password are required']);
    exit;
}

// Additional input validation
if (strlen($password) < 6) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Invalid credentials']);
    exit;
}

try {
    $user = null;
    $user_type = null;
    $user_id = null;
    $redirect_url = '';

    // Check Admin table first
    $stmt = $pdo->prepare("SELECT admin_id as id, name, email, password, role FROM admin WHERE email = ?");
    $stmt->execute([$email]);
    $admin = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($admin && password_verify($password, $admin['password'])) {
        $user = $admin;
        $user_type = 'admin';
        $user_id = $admin['id'];
        $redirect_url = 'pages/admin/dashboard.php';
        $user['first_name'] = $admin['name'];
        $user['last_name'] = '';
    }

    // Check Instructor table if not admin
    if (!$user) {
        $stmt = $pdo->prepare("SELECT instructor_id as id, first_name, last_name, email, password FROM instructor WHERE email = ?");
        $stmt->execute([$email]);
        $instructor = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($instructor && password_verify($password, $instructor['password'])) {
            $user = $instructor;
            $user_type = 'instructor';
            $user_id = $instructor['id'];
            $redirect_url = 'pages/intructor/intructor.php';
            $user['role'] = 'Instructor';
        }
    }

    // Check Student table if not admin or instructor
    if (!$user) {
        // Check by email first
        $stmt = $pdo->prepare("SELECT student_id as id, first_name, last_name, email, password, status FROM student WHERE email = ? AND status = 'active'");
        $stmt->execute([$email]);
        $student = $stmt->fetch(PDO::FETCH_ASSOC);
        
        // If not found by email, check by student_id (assuming email field might contain student ID)
        if (!$student && is_numeric($email)) {
            $stmt = $pdo->prepare("SELECT student_id as id, first_name, last_name, email, password, status FROM student WHERE student_id = ? AND status = 'active'");
            $stmt->execute([$email]);
            $student = $stmt->fetch(PDO::FETCH_ASSOC);
        }
        
        if ($student && password_verify($password, $student['password'])) {
            $user = $student;
            $user_type = 'student';
            $user_id = $student['id'];
            $redirect_url = 'pages/student/student.dashboard.php';
            $user['role'] = 'Student';
        }
    }

    // If no user found or password doesn't match
    if (!$user) {
        // Log failed attempt for rate limiting
        logRateLimitAttempt('login', $ip);
        
        http_response_code(401);
        echo json_encode(['success' => false, 'message' => 'Invalid email/student ID or password']);
        exit;
    }

    // Clear rate limiting on successful login
    clearRateLimit('login', $ip);

    // Regenerate session ID for security
    session_regenerate_id(true);

    // Set session variables
    $_SESSION['user_id'] = $user_id;
    $_SESSION['user_type'] = $user_type;
    $_SESSION['email'] = $user['email'];
    $_SESSION['first_name'] = $user['first_name'];
    $_SESSION['last_name'] = $user['last_name'];
    $_SESSION['role'] = $user['role'] ?? ucfirst($user_type);
    $_SESSION['is_logged_in'] = true;
    $_SESSION['login_time'] = time();
    $_SESSION['last_activity'] = time();

    // Set additional session variables based on user type
    if ($user_type === 'student') {
        $_SESSION['student_id'] = $user_id;
    } elseif ($user_type === 'instructor') {
        $_SESSION['instructor_id'] = $user_id;
    } elseif ($user_type === 'admin') {
        $_SESSION['admin_id'] = $user_id;
    }

    // Return success response with role-based redirection
    echo json_encode([
        'success' => true,
        'message' => 'Login successful',
        'redirect_url' => $redirect_url,
        'user' => [
            'id' => $user_id,
            'type' => $user_type,
            'email' => $user['email'],
            'first_name' => $user['first_name'],
            'last_name' => $user['last_name'],
            'role' => $user['role'] ?? ucfirst($user_type),
            'full_name' => trim($user['first_name'] . ' ' . $user['last_name'])
        ]
    ]);

} catch (PDOException $e) {
    // Log error for debugging (don't expose database errors to users)
    error_log("Login database error: " . $e->getMessage());
    
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'A system error occurred. Please try again later.']);
} catch (Exception $e) {
    // Log error for debugging
    error_log("Login system error: " . $e->getMessage());
    
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'A system error occurred. Please try again later.']);
}
?>
