<?php
session_start();
session_unset();  // Unset all session variables
session_destroy(); // Destroy the session

// Remove the session cookie (optional, but recommended for complete logout)
if (isset($_COOKIE[session_name()])) {
    setcookie(session_name(), '', time() - 3600, '/');
}

// Redirect to login page
header("Location: index.php");
exit();
?>
