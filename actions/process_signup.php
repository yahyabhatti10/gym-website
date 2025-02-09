<?php
// Start the session to manage error messages and user data
session_start();

// Include the database connection configuration file
include('../includes/config.php'); // Connect to the database

// Check if form is submitted using POST method
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form input values and trim spaces
    $full_name = trim($_POST['full_name']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $confirm_password = trim($_POST['confirm_password']);

    // Initialize an error message variable
    $error = '';

    try {
        // Check if the email already exists in the database
        $check_email_query = "SELECT id FROM users WHERE email = :email";
        $stmt = $pdo->prepare($check_email_query);
        $stmt->bindParam(":email", $email);
        $stmt->execute();

        // If the email is already registered
        if ($stmt->rowCount() > 0) {
            $error = "You already have an account!";
        }
        // If passwords do not match
        elseif ($password !== $confirm_password) {
            $error = "Passwords do not match!";
        } else {
            // Hash the password for security
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Insert the new user's data into the database
            $query = "INSERT INTO users (full_name, email, hashed_password) VALUES (:full_name, :email, :hashed_password)";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(":full_name", $full_name);
            $stmt->bindParam(":email", $email);
            $stmt->bindParam(":hashed_password", $hashed_password);

            // If the user is successfully inserted into the database
            if ($stmt->execute()) {
                // Store user data in session and redirect to dashboard
                $_SESSION['user_id'] = $pdo->lastInsertId(); // Save the user's ID
                $_SESSION['user_email'] = $email; // Save the user's email
                header("Location: ../public/index.php"); // Redirect to the dashboard page
                exit();
            } else {
                // If there was an error while inserting the user
                $error = "Error registering account!";
            }
        }
    } catch (PDOException $e) {
        // If there is a database error, capture the message
        $error = "Error: " . $e->getMessage();
    }

    // If there's an error, store the error message in session and redirect to the signup page
    $_SESSION['error'] = $error;
    header("Location: ../public/signup.php"); // Redirect back to the signup page
    exit();
}
?>
