<?php
// Simple instructors list without authentication - FIXED VERSION
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET');
header('Access-Control-Allow-Headers: Content-Type');

try {
    require_once __DIR__ . '/../../../../config/db.php';
    
    $stmt = $pdo->prepare('
        SELECT 
            instructor_id,
            first_name,
            last_name,
            email,
            assigned_subject,
            section_handled,
            schedule_day,
            schedule_time
        FROM instructor
        ORDER BY instructor_id DESC
    ');
    $stmt->execute();
    $instructors = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode([
        'success' => true,
        'data' => $instructors,
        'count' => count($instructors)
    ]);
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
