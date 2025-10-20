<?php
// Create instructor API endpoint
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

try {
    require_once __DIR__ . '/../../../../config/db.php';
    
    // Get JSON input
    $input = json_decode(file_get_contents('php://input'), true);
    
    if (!$input) {
        throw new Exception('Invalid JSON input');
    }
    
    // Validate required fields
    if (empty($input['first_name']) || empty($input['last_name']) || empty($input['email'])) {
        throw new Exception('First name, last name, and email are required');
    }
    
    // Generate temporary password
    $tempPassword = bin2hex(random_bytes(4)); // 8-character temp password
    $hashedPassword = password_hash($tempPassword, PASSWORD_DEFAULT);
    
    // Insert instructor
    $stmt = $pdo->prepare("
        INSERT INTO instructor (
            admin_id, 
            first_name, 
            last_name, 
            email, 
            password, 
            assigned_subject, 
            subject_code,
            section_handled, 
            program,
            schedule_day, 
            schedule_time
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
    ");
    
    $stmt->execute([
        1, // Default admin_id - you might want to get this from session
        $input['first_name'],
        $input['last_name'],
        $input['email'],
        $hashedPassword,
        $input['assigned_subject'] ?? null,
        $input['subject_code'] ?? null,
        $input['section_handled'] ?? null,
        $input['program'] ?? 'BS-InfoTech',
        $input['schedule_day'] ?? null,
        $input['schedule_time'] ?? null
    ]);
    
    echo json_encode([
        'success' => true,
        'message' => 'Instructor created successfully',
        'temp_password' => $tempPassword,
        'instructor_id' => $pdo->lastInsertId()
    ]);
    
} catch (PDOException $e) {
    http_response_code(500);
    if ($e->getCode() == 23000) { // Duplicate entry
        echo json_encode([
            'success' => false,
            'message' => 'Email already exists'
        ]);
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'Database error: ' . $e->getMessage()
        ]);
    }
} catch (Exception $e) {
    http_response_code(400);
    echo json_encode([
        'success' => false,
        'message' => $e->getMessage()
    ]);
}
?>
