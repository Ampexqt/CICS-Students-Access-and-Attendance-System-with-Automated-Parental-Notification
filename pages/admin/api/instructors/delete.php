<?php
// pages/admin/api/instructors/delete.php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: DELETE, POST');
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

$raw = file_get_contents('php://input');
$data = json_decode($raw, true);

if (!is_array($data)) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Invalid JSON payload']);
    exit;
}

$instructorId = $data['instructor_id'] ?? null;

if (!$instructorId) {
    http_response_code(422);
    echo json_encode(['success' => false, 'message' => 'Instructor ID is required']);
    exit;
}

try {
    $pdo->beginTransaction();

    // Check if instructor exists
    $stmt = $pdo->prepare('SELECT COUNT(*) FROM instructor WHERE instructor_id = ?');
    $stmt->execute([$instructorId]);
    if ($stmt->fetchColumn() == 0) {
        $pdo->rollBack();
        http_response_code(404);
        echo json_encode(['success' => false, 'message' => 'Instructor not found']);
        exit;
    }

    // Check if instructor has associated students
    $stmt = $pdo->prepare('SELECT COUNT(*) FROM student WHERE instructor_id = ?');
    $stmt->execute([$instructorId]);
    $studentCount = $stmt->fetchColumn();

    if ($studentCount > 0) {
        $pdo->rollBack();
        http_response_code(409);
        echo json_encode([
            'success' => false, 
            'message' => "Cannot delete instructor. {$studentCount} student(s) are assigned to this instructor."
        ]);
        exit;
    }

    // Delete instructor
    $stmt = $pdo->prepare('DELETE FROM instructor WHERE instructor_id = ?');
    $stmt->execute([$instructorId]);

    $pdo->commit();

    echo json_encode([
        'success' => true,
        'message' => 'Instructor deleted successfully'
    ]);
} catch (Throwable $e) {
    if ($pdo->inTransaction()) {
        $pdo->rollBack();
    }
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Server error', 'error' => $e->getMessage()]);
}
