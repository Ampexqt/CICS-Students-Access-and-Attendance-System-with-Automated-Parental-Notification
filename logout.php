<?php
/**
 * Logout Handler
 * Securely logs out users and destroys their session
 */

// Include authentication middleware
require_once 'middleware/auth.php';

// Check if user is logged in
if (!isAuthenticated()) {
    // Already logged out, redirect to login
    header('Location: login.php');
    exit;
}

// Log the logout action
error_log("User logout: ID " . ($_SESSION['user_id'] ?? 'unknown') . 
         " (" . ($_SESSION['user_type'] ?? 'unknown') . ") from IP " . 
         ($_SERVER['REMOTE_ADDR'] ?? 'unknown'));

// Perform logout
logout();

// Redirect to login page with success message
header('Location: login.php?message=logged_out');
exit;
?>
