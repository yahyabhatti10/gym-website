<?php
// Start the session to store error or success messages for user feedback
session_start();

// Include the configuration file to establish a database connection
include('../includes/config.php'); 

// Check if the form was submitted via POST method
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize user input from the form
    $full_name = trim($_POST["full_name"]);
    $email = trim($_POST["email"]);
    $new_password = trim($_POST["new_password"]); 
    $confirm_password = trim($_POST["confirm_password"]); 

    // Validate if any of the fields are empty
    if (empty($full_name) || empty($email) || empty($new_password) || empty($confirm_password)) {
        // If fields are empty, set an error message and redirect the user back to the forgot password page
        $_SESSION['error'] = "All fields are required.";
        header("Location: ../public/forgot_password.php");
        exit();
    }

    // Check if the new password and confirm password match
    if ($new_password !== $confirm_password) {
        // If passwords do not match, set an error message and redirect the user back to the forgot password page
        $_SESSION['error'] = "Passwords do not match.";
        header("Location: ../public/forgot_password.php");
        exit();
    }

    try {
        // Prepare a query to check if the user exists in the database by matching full name and email
        $stmt = $pdo->prepare("SELECT * FROM users WHERE full_name = ? AND email = ?"); // Using PDO for database interaction
        $stmt->execute([$full_name, $email]); // Execute the query with the input values
        $user = $stmt->fetch(PDO::FETCH_ASSOC); // Fetch the matching user record

        // If user is found, proceed to update the password
        if ($user) {
            // Hash the new password using bcrypt for secure storage in the database
            $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

            // Prepare a query to update the password for the user with the given email
            $update_stmt = $pdo->prepare("UPDATE users SET hashed_password = ? WHERE email = ?"); // Using PDO
            $update_stmt->execute([$hashed_password, $email]); // Execute the update with the hashed password and email

            // Set a success message in the session and redirect the user back to the forgot password page
            $_SESSION['success'] = "Password updated successfully.";
            header("Location: ../public/forgot_password.php");
            exit();
        } else {
            // If no user is found with the provided full name and email, set an error message
            $_SESSION['error'] = "No matching user found.";
            header("Location: ../public/forgot_password.php");
            exit();
        }
    } catch (PDOException $e) {
        // If there is any exception during database interaction, set a general error message
        $_SESSION['error'] = "Something went wrong. Please try again.";
        header("Location: ../public/forgot_password.php");
        exit();
    }
} else {
    // If the form is not submitted via POST, redirect the user back to the forgot password page
    header("Location: ../public/forgot_password.php");
    exit();
}
?>
