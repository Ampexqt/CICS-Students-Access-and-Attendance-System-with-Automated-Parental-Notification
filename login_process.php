<?php
// Start session
session_start();

// Include database configuration
require_once 'config/db.php';

// Set content type to JSON for AJAX responses
header('Content-Type: application/json');

// Check if request method is POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Method not allowed']);
    exit;
}

// Get input data
$email = trim($_POST['email'] ?? '');
$password = $_POST['password'] ?? '';

// Validate input
if (empty($email) || empty($password)) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Email and password are required']);
    exit;
}

try {
    // Prepare SQL query to check user credentials
    $stmt = $pdo->prepare("SELECT * FROM users WHERE (email = ? OR student_id = ?) AND status = 'active'");
    $stmt->execute([$email, $email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        http_response_code(401);
        echo json_encode(['success' => false, 'message' => 'Invalid email/student ID or password']);
        exit;
    }

    // Verify password
    if (!password_verify($password, $user['password'])) {
        http_response_code(401);
        echo json_encode(['success' => false, 'message' => 'Invalid email/student ID or password']);
        exit;
    }

    // Check if user is already logged in on another device (optional security feature)
    if ($user['is_logged_in'] == 1) {
        http_response_code(409);
        echo json_encode(['success' => false, 'message' => 'Account is already logged in on another device']);
        exit;
    }

    // Update login status and last login time
    $updateStmt = $pdo->prepare("UPDATE users SET is_logged_in = 1, last_login = NOW() WHERE id = ?");
    $updateStmt->execute([$user['id']]);

    // Set session variables
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['email'] = $user['email'];
    $_SESSION['student_id'] = $user['student_id'];
    $_SESSION['first_name'] = $user['first_name'];
    $_SESSION['last_name'] = $user['last_name'];
    $_SESSION['role'] = $user['role'];
    $_SESSION['is_logged_in'] = true;

    // Log successful login (optional)
    $logStmt = $pdo->prepare("INSERT INTO login_logs (user_id, login_time, ip_address, user_agent) VALUES (?, NOW(), ?, ?)");
    $logStmt->execute([$user['id'], $_SERVER['REMOTE_ADDR'] ?? 'unknown', $_SERVER['HTTP_USER_AGENT'] ?? 'unknown']);

    // Return success response
    echo json_encode([
        'success' => true,
        'message' => 'Login successful',
        'redirect_url' => 'dashboard.php', // You can customize this based on user role
        'user' => [
            'id' => $user['id'],
            'email' => $user['email'],
            'student_id' => $user['student_id'],
            'first_name' => $user['first_name'],
            'last_name' => $user['last_name'],
            'role' => $user['role']
        ]
    ]);

} catch (PDOException $e) {
    // Log error for debugging
    error_log("Login error: " . $e->getMessage());
    
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'An error occurred during login. Please try again.']);
} catch (Exception $e) {
    // Log error for debugging
    error_log("Login error: " . $e->getMessage());
    
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'An error occurred during login. Please try again.']);
}
?>
