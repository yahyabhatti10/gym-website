<!-- /*
 * This file, config.php, sets up the database connection using PHP Data Objects (PDO).
 * It defines constants for the MySQL server details including the server name, username, password, and database name.
 * These constants are then used to create a new PDO instance with error handling set to throw exceptions
 * and with the default fetch mode set to associative arrays, making it easier to work with query results.
 * If the connection fails, the script stops and displays an error message.
 */ -->

<?php
// Database connection settings
define('DB_SERVER', 'localhost');  // The server where MySQL is running (usually localhost)
define('DB_USERNAME', 'root');     // Default MySQL username for XAMPP is 'root'
define('DB_PASSWORD', '');         // Default MySQL password for XAMPP is an empty string (leave it blank)
define('DB_DATABASE', 'gym_website_db');  // The name of the database you just created

// Create a connection to MySQL using PDO
try {
    $pdo = new PDO("mysql:host=" . DB_SERVER . ";dbname=" . DB_DATABASE, DB_USERNAME, DB_PASSWORD, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>
