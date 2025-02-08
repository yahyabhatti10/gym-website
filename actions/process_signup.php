<?php
session_start();
include('../includes/config.php'); // Include the database connection

// Check if form is submitted via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form input values
    $full_name = trim($_POST['full_name']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $confirm_password = trim($_POST['confirm_password']);

    // Initialize error message
    $error = '';

    // Check if email already exists
    try {
        $check_email_query = "SELECT id FROM users WHERE email = :email";
        $stmt = $pdo->prepare($check_email_query);
        $stmt->bindParam(":email", $email);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $error = "You already have an account!";
        } elseif ($password !== $confirm_password) {
            $error = "Passwords do not match!";
        } else {
            // Hash the password
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Insert the new user into the database
            $query = "INSERT INTO users (full_name, email, hashed_password) VALUES (:full_name, :email, :hashed_password)";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(":full_name", $full_name);
            $stmt->bindParam(":email", $email);
            $stmt->bindParam(":hashed_password", $hashed_password);

            if ($stmt->execute()) {
                // Store session data and redirect
                $_SESSION['user_id'] = $pdo->lastInsertId();
                $_SESSION['user_email'] = $email;
                header("Location: ../public/index.php"); // Redirect to dashboard after signup
                exit();
            } else {
                $error = "Error registering account!";
            }
        }
    } catch (PDOException $e) {
        $error = "Error: " . $e->getMessage();
    }

    // If there's an error, redirect back to signup page with the error message in session
    $_SESSION['error'] = $error;
    header("Location: ../public/signup.php"); // Redirect back to the signup page
    exit();
}
