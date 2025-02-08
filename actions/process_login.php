<?php
session_start();
include('../includes/config.php'); // Database connection file

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $error = '';

    // Query to check user credentials
    $query = "SELECT * FROM users WHERE email = ?";
    $stmt = $pdo->prepare($query);  // Use $pdo instead of $conn
    $stmt->bindParam(1, $email, PDO::PARAM_STR); // Bind the email parameter
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC); // Fetch the result as an associative array

    // Check if email exists
    if ($result) {
        // Verify password
        if (password_verify($password, $result['hashed_password'])) {
            // Set session variables and redirect to dashboard
            $_SESSION['user_id'] = $result['id'];
            $_SESSION['user_email'] = $result['email'];
            
            // Redirect to dashboard after login (adjusted path)
            header("Location: ../public/index.php");
            exit();
        } else {
            $error = "Incorrect password!";
        }
    } else {
        $error = "No account found with that email address!";
    }

    // If there's an error, set the session error message and redirect back to login page
    $_SESSION['error'] = $error;
    header("Location: ../public/login.php"); // Absolute path to login page
    exit();
}
?>
