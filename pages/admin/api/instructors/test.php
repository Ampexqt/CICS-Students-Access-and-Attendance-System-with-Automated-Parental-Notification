<?php
// Test endpoint to check database connection and instructors table
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

try {
    require_once __DIR__ . '/../../../../config/db.php';
    
    // Test basic connection
    $stmt = $pdo->query('SELECT COUNT(*) as count FROM instructor');
    $count = $stmt->fetch(PDO::FETCH_ASSOC);
    
    // Get sample instructor data
    $stmt = $pdo->prepare('SELECT * FROM instructor LIMIT 3');
    $stmt->execute();
    $instructors = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo json_encode([
        'success' => true,
        'message' => 'Database connection successful',
        'instructor_count' => $count['count'],
        'sample_data' => $instructors
    ]);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => 'Database error: ' . $e->getMessage()
    ]);
}
?>
