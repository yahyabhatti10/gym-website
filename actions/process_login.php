<?php
// Start a session to store user data or error messages
session_start();

// Include the configuration file to set up a database connection
include('../includes/config.php'); // Database connection file

// Check if the form is submitted using POST method
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize the email and password entered by the user
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $error = ''; // Variable to store any error messages

    // Query to check user credentials by email
    $query = "SELECT * FROM users WHERE email = ?"; 
    $stmt = $pdo->prepare($query);  // Use $pdo to prepare the query
    $stmt->bindParam(1, $email, PDO::PARAM_STR); // Bind the email parameter for the query
    $stmt->execute(); // Execute the query to search for the user by email
    $result = $stmt->fetch(PDO::FETCH_ASSOC); // Fetch the result as an associative array

    // Check if the user exists with the given email
    if ($result) {
        // If user is found, verify the entered password against the hashed password in the database
        if (password_verify($password, $result['hashed_password'])) {
            // If password matches, set session variables to keep track of the logged-in user
            $_SESSION['user_id'] = $result['id'];
            $_SESSION['user_email'] = $result['email'];
            
            // Redirect to the dashboard after successful login
            header("Location: ../public/index.php"); // Adjusted to the correct dashboard path
            exit(); // Stop further script execution
        } else {
            // If the password is incorrect, set an error message
            $error = "Incorrect password!";
        }
    } else {
        // If no user is found with the given email, set an error message
        $error = "No account found with that email address!";
    }

    // If there is an error, set it in the session and redirect back to the login page
    $_SESSION['error'] = $error;
    header("Location: ../public/login.php"); // Redirect back to the login page with the error message
    exit(); // Stop further script execution
}
?>
