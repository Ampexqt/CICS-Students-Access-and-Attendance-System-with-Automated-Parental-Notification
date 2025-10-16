<?php
// Database credentials
$host = 'localhost';       // Your database host (usually 'localhost')
$dbname = 'cics_attendance_db'; // The name of your database
$username = 'root';        // Your MySQL username
$password = '';            // Your MySQL password (empty by default in XAMPP)

// Set up DSN (Data Source Name)
$dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";

try {
    // Create a PDO instance (connect to the database)
    $pdo = new PDO($dsn, $username, $password);

    // Set error reporting mode to Exception for debugging
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Database connected successfully - no output needed for included files
} catch (PDOException $e) {
    // Catch any connection errors
    die("❌ Connection failed: " . $e->getMessage());
    
}
?>
