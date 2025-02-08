<?php
session_start();

// Destroy the session and logout
session_unset(); // Unset all session variables
session_destroy(); // Destroy the session

// Redirect to login page after logout
header('Location: ../public/index.php');
exit();
?>
