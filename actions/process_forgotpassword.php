<?php
session_start();
include('../includes/config.php'); 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $full_name = trim($_POST["full_name"]);
    $email = trim($_POST["email"]);
    $new_password = trim($_POST["new_password"]); 
    $confirm_password = trim($_POST["confirm_password"]); 

    // Validate input
    if (empty($full_name) || empty($email) || empty($new_password) || empty($confirm_password)) {
        $_SESSION['error'] = "All fields are required.";
        header("Location: ../public/forgot_password.php");
        exit();
    }

    if ($new_password !== $confirm_password) {
        $_SESSION['error'] = "Passwords do not match.";
        header("Location: ../public/forgot_password.php");
        exit();
    }

    try {
        // Check if user exists
        $stmt = $pdo->prepare("SELECT * FROM users WHERE full_name = ? AND email = ?"); // Changed $conn to $pdo
        $stmt->execute([$full_name, $email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            // Hash the new password
            $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

            // Update password
            $update_stmt = $pdo->prepare("UPDATE users SET hashed_password = ? WHERE email = ?"); // Changed $conn to $pdo
            $update_stmt->execute([$hashed_password, $email]);

            $_SESSION['success'] = "Password updated successfully.";
            header("Location: ../public/forgot_password.php");
            exit();
        } else {
            $_SESSION['error'] = "No matching user found.";
            header("Location: ../public/forgot_password.php");
            exit();
        }
    } catch (PDOException $e) {
        $_SESSION['error'] = "Something went wrong. Please try again.";
        header("Location: ../public/forgot_password.php");
        exit();
    }
} else {
    header("Location: ../public/forgot_password.php");
    exit();
}
