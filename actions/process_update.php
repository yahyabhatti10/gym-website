<?php
session_start();
include('../includes/config.php');

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: ../public/login.php');
    exit();
}

$user_id = $_SESSION['user_id'];

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $phone = trim($_POST['phone']);
    $weight_kg = trim($_POST['weight_kg']);
    $age = trim($_POST['age']);
    $plan_type = $_POST['plan_type'];

    // Validation
    if (!preg_match('/^\d{10,15}$/', $phone)) {
        header("Location: ../public/dashboard.php?status=invalid_phone");
        exit();
    }

    if (!is_numeric($weight_kg) || $weight_kg <= 0) {
        header("Location: ../public/dashboard.php?status=invalid_weight");
        exit();
    }

    if (!is_numeric($age) || $age <= 15) {
        header("Location: ../public/dashboard.php?status=invalid_age");
        exit();
    }

    // Update membership information in the database
    $query = "UPDATE memberships SET phone = ?, weight_kg = ?, age = ?, plan_type = ? WHERE user_id = ?";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(1, $phone, PDO::PARAM_STR);
    $stmt->bindParam(2, $weight_kg, PDO::PARAM_STR);
    $stmt->bindParam(3, $age, PDO::PARAM_INT);
    $stmt->bindParam(4, $plan_type, PDO::PARAM_STR);
    $stmt->bindParam(5, $user_id, PDO::PARAM_INT);

    if ($stmt->execute()) {
        header("Location: ../public/dashboard.php?status=success");
        exit();
    } else {
        header("Location: ../public/dashboard.php?status=error");
        exit();
    }
}
?>
