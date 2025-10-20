<?php
// pages/admin/api/instructors/list.php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET');
header('Access-Control-Allow-Headers: Content-Type');

require_once __DIR__ . '/../../../../config/db.php';
require_once __DIR__ . '/../../../../middleware/auth.php';

try {
    requireRole('Dean');
} catch (Throwable $e) {
    http_response_code(401);
    echo json_encode(['success' => false, 'message' => 'Unauthorized']);
    exit;
}

try {
    $stmt = $pdo->prepare('
        SELECT 
            i.instructor_id,
            i.first_name,
            i.last_name,
            i.email,
            i.assigned_subject,
            i.subject_code,
            i.section_handled,
            i.program,
            i.schedule_day,
            i.schedule_time,
            a.name as admin_name
        FROM instructor i
        LEFT JOIN admin a ON i.admin_id = a.admin_id
        ORDER BY i.instructor_id DESC
    ');
    $stmt->execute();
    $instructors = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode([
        'success' => true,
        'data' => $instructors
    ]);
} catch (Throwable $e) {
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => 'Server error',
        'error' => $e->getMessage()
    ]);
}
