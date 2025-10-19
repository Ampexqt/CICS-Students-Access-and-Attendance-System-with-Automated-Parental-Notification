<?php
// Simple delete instructor without authentication
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: DELETE, POST');
header('Access-Control-Allow-Headers: Content-Type');

try {
    require_once __DIR__ . '/../../../../config/db.php';
    
    // Get JSON input
    $raw = file_get_contents('php://input');
    $data = json_decode($raw, true);
    
    if (!$data) {
        throw new Exception('Invalid JSON input');
    }
    
    $instructorId = $data['instructor_id'] ?? null;
    
    if (!$instructorId) {
        throw new Exception('Instructor ID is required');
    }
    
    // Check if instructor exists
    $stmt = $pdo->prepare('SELECT COUNT(*) FROM instructor WHERE instructor_id = ?');
    $stmt->execute([$instructorId]);
    if ($stmt->fetchColumn() == 0) {
        throw new Exception('Instructor not found');
    }
    
    // Delete instructor
    $stmt = $pdo->prepare('DELETE FROM instructor WHERE instructor_id = ?');
    $stmt->execute([$instructorId]);
    
    echo json_encode([
        'success' => true,
        'message' => 'Instructor deleted successfully'
    ]);
    
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => $e->getMessage()
    ]);
}
?>
