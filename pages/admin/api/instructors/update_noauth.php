<?php
// Simple instructor update without authentication - for testing
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: PUT, POST');
header('Access-Control-Allow-Headers: Content-Type');

try {
    require_once __DIR__ . '/../../../../config/db.php';
    
    $raw = file_get_contents('php://input');
    $data = json_decode($raw, true);
    
    if (!is_array($data)) {
        http_response_code(400);
        echo json_encode(['success' => false, 'message' => 'Invalid JSON payload']);
        exit;
    }
    
    $instructorId = $data['instructor_id'] ?? null;
    $firstName = trim($data['first_name'] ?? '');
    $lastName = trim($data['last_name'] ?? '');
    $email = trim($data['email'] ?? '');
    $subject = trim($data['assigned_subject'] ?? '');
    $subjectCode = trim($data['subject_code'] ?? '');
    $section = trim($data['section_handled'] ?? '');
    $program = trim($data['program'] ?? 'BS-InfoTech');
    $scheduleDay = trim($data['schedule_day'] ?? '');
    $scheduleTime = trim($data['schedule_time'] ?? '');
    
    $errors = [];
    if (!$instructorId) $errors[] = 'Instructor ID is required';
    if ($firstName === '') $errors[] = 'First name is required';
    if ($lastName === '') $errors[] = 'Last name is required';
    if ($email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = 'Valid email is required';
    if ($program !== 'BS-InfoTech' && $program !== 'BS-InfoSys') $errors[] = 'Invalid program selected';
    
    if ($errors) {
        http_response_code(422);
        echo json_encode(['success' => false, 'message' => 'Validation failed', 'errors' => $errors]);
        exit;
    }
    
    try {
        $pdo->beginTransaction();
        
        // Check if email exists for other instructors
        $stmt = $pdo->prepare('SELECT COUNT(*) FROM instructor WHERE email = ? AND instructor_id != ?');
        $stmt->execute([$email, $instructorId]);
        if ($stmt->fetchColumn() > 0) {
            $pdo->rollBack();
            http_response_code(409);
            echo json_encode(['success' => false, 'message' => 'Email already exists']);
            exit;
        }
        
        // Update instructor
        $stmt = $pdo->prepare('
            UPDATE instructor 
            SET first_name = ?, last_name = ?, email = ?, assigned_subject = ?, 
                subject_code = ?, section_handled = ?, program = ?, schedule_day = ?, schedule_time = ?
            WHERE instructor_id = ?
        ');
        $stmt->execute([
            $firstName,
            $lastName,
            $email,
            $subject ?: null,
            $subjectCode ?: null,
            $section ?: null,
            $program,
            $scheduleDay ?: null,
            $scheduleTime ?: null,
            $instructorId
        ]);
        
        $pdo->commit();
        
        echo json_encode([
            'success' => true,
            'message' => 'Instructor updated successfully'
        ]);
    } catch (Throwable $e) {
        if ($pdo->inTransaction()) {
            $pdo->rollBack();
        }
        http_response_code(500);
        echo json_encode(['success' => false, 'message' => 'Server error: ' . $e->getMessage()]);
    }
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => 'Server error: ' . $e->getMessage(),
        'file' => __FILE__,
        'line' => __LINE__
    ]);
}
?>
