<?php
// Simple database test
header('Content-Type: application/json');

try {
    require_once __DIR__ . '/../../config/db.php';
    
    // Test if instructor table exists and what columns it has
    $stmt = $pdo->query("DESCRIBE instructor");
    $columns = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Try to get instructors without created_at
    $stmt = $pdo->prepare("SELECT instructor_id, first_name, last_name, email FROM instructor LIMIT 5");
    $stmt->execute();
    $instructors = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo json_encode([
        'success' => true,
        'columns' => $columns,
        'instructors' => $instructors,
        'message' => 'Database connection successful'
    ]);
} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'error' => $e->getMessage(),
        'line' => $e->getLine(),
        'file' => $e->getFile()
    ]);
}
?>
