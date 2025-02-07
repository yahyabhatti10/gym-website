<?php
// Include the database configuration file
include('../includes/config.php');

// Check if the connection is successful
if (isset($pdo)) {
    echo "Database connected successfully!";
} else {
    echo "Failed to connect to the database.";
}
?>
