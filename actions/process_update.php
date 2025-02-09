<?php
// Start the session to manage user login status and data
session_start();

// Include the database connection configuration file
include('../includes/config.php');

// Check if the user is logged in, otherwise redirect to login page
if (!isset($_SESSION['user_id'])) {
    header('Location: ../public/login.php'); // Redirect to login if not logged in
    exit();
}

// Get the logged-in user's ID from the session
$user_id = $_SESSION['user_id'];

// Check if the form is submitted using POST method
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get and sanitize the form input values
    $phone = trim($_POST['phone']);
    $weight_kg = trim($_POST['weight_kg']);
    $age = trim($_POST['age']);
    $plan_type = $_POST['plan_type'];

    // Validation for phone number (must be numeric, and between 10 and 15 digits)
    if (!preg_match('/^\d{10,15}$/', $phone)) {
        header("Location: ../public/dashboard.php?status=invalid_phone"); // Redirect with error if invalid
        exit();
    }

    // Validation for weight (must be a positive number)
    if (!is_numeric($weight_kg) || $weight_kg <= 0) {
        header("Location: ../public/dashboard.php?status=invalid_weight"); // Redirect with error if invalid
        exit();
    }

    // Validation for age (must be a number greater than 15)
    if (!is_numeric($age) || $age <= 15) {
        header("Location: ../public/dashboard.php?status=invalid_age"); // Redirect with error if invalid
        exit();
    }

    // Update membership details in the database
    $query = "UPDATE memberships SET phone = ?, weight_kg = ?, age = ?, plan_type = ? WHERE user_id = ?";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(1, $phone, PDO::PARAM_STR); // Bind phone parameter
    $stmt->bindParam(2, $weight_kg, PDO::PARAM_STR); // Bind weight parameter
    $stmt->bindParam(3, $age, PDO::PARAM_INT); // Bind age parameter
    $stmt->bindParam(4, $plan_type, PDO::PARAM_STR); // Bind plan_type parameter
    $stmt->bindParam(5, $user_id, PDO::PARAM_INT); // Bind user ID for the update

    // Check if the query executed successfully
    if ($stmt->execute()) {
        // If successful, redirect to dashboard with success status
        header("Location: ../public/dashboard.php?status=success");
        exit();
    } else {
        // If there's an error in updating, redirect with error status
        header("Location: ../public/dashboard.php?status=error");
        exit();
    }
}
?>
