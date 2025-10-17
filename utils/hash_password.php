<?php
/**
 * Password Hashing Utility
 * Use this script to generate password hashes for database insertion
 */

// Include security configuration
require_once '../config/security.php';

// Function to generate hash for a password
function generatePasswordHash($password) {
    return hashPassword($password);
}

// Example usage
if (php_sapi_name() === 'cli') {
    // Command line usage
    if ($argc < 2) {
        echo "Usage: php hash_password.php <password>\n";
        exit(1);
    }
    
    $password = $argv[1];
    $hash = generatePasswordHash($password);
    
    echo "Password: $password\n";
    echo "Hash: $hash\n";
} else {
    // Web usage (for development only - remove in production)
    if (isset($_GET['password'])) {
        $password = $_GET['password'];
        $hash = generatePasswordHash($password);
        
        echo "<h3>Password Hash Generator</h3>";
        echo "<p><strong>Password:</strong> " . htmlspecialchars($password) . "</p>";
        echo "<p><strong>Hash:</strong> " . htmlspecialchars($hash) . "</p>";
        echo "<hr>";
        echo "<p><strong>SQL Example:</strong></p>";
        echo "<code>UPDATE users SET password = '" . htmlspecialchars($hash) . "' WHERE email = 'user@example.com';</code>";
    } else {
        echo "<h3>Password Hash Generator</h3>";
        echo "<form method='GET'>";
        echo "<input type='text' name='password' placeholder='Enter password' required>";
        echo "<button type='submit'>Generate Hash</button>";
        echo "</form>";
        echo "<p><em>Note: This tool is for development only. Remove in production.</em></p>";
    }
}

// Pre-generated hashes for common test passwords
echo "\n<!-- Common test password hashes:\n";
echo "password: " . generatePasswordHash('password') . "\n";
echo "admin123: " . generatePasswordHash('admin123') . "\n";
echo "student123: " . generatePasswordHash('student123') . "\n";
echo "instructor123: " . generatePasswordHash('instructor123') . "\n";
echo "-->\n";
?>
