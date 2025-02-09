<?php
// Start the session to manage messages and user data
session_start();

// Include the database connection configuration file
include('../includes/config.php');

// Check if the form is submitted using POST method
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Fetch form data sent from the registration page
    $user_id = $_SESSION['user_id']; // Get user ID from session
    $phone = $_POST['phone']; // User's phone number
    $weight_kg = $_POST['weight_kg']; // User's weight in kilograms
    $age = $_POST['age']; // User's age
    $plan_type = $_POST['plan_type']; // Selected plan type (monthly/yearly)
    $services = isset($_POST['services']) ? $_POST['services'] : []; // Selected additional services

    // Age validation: Ensure the user is at least 15 years old
    if ($age < 15) {
        $_SESSION['message'] = "Age must be greater than 15.";
        $_SESSION['message_class'] = "error"; // CSS class for error styling
        header("Location: ../public/register.php"); // Redirect back to the registration page
        exit;
    }

    // Default payment calculation based on the selected plan type (monthly or yearly)
    if ($plan_type === 'monthly') {
        $payment_amount = 40; // Default price for monthly plan
    } else {
        $payment_amount = 400; // Default price for yearly plan
    }

    // Add service prices to the total payment
    $total_service_price = 0;
    foreach ($services as $service_id) {
        // Get the price of each selected service from the database
        $stmt = $pdo->prepare("SELECT price FROM services WHERE id = :id");
        $stmt->execute(['id' => $service_id]);
        $service = $stmt->fetch(PDO::FETCH_ASSOC);
        $total_service_price += $service['price']; // Add service price to total
    }

    // Adjust the payment for the selected plan and add-on services
    if ($plan_type === 'Monthly') {
        $payment_amount += $total_service_price; // Add service prices for monthly plan
    } else {
        $payment_amount += $total_service_price * 10;  // Multiply add-on price by 10 for yearly plan
    }

    // Set the start and end date based on the selected plan type
    $start_date = date('Y-m-d'); // Current date as start date
    if ($plan_type === 'monthly') {
        $end_date = date('Y-m-d', strtotime("+1 month")); // One month later for monthly plan
    } else {
        $end_date = date('Y-m-d', strtotime("+1 year")); // One year later for yearly plan
    }

    try {
        // Insert the membership details into the database
        $stmt = $pdo->prepare("INSERT INTO memberships (user_id, phone, weight_kg, age, plan_type, start_date, end_date) 
                               VALUES (:user_id, :phone, :weight_kg, :age, :plan_type, :start_date, :end_date)");
        $stmt->execute([
            'user_id' => $user_id,
            'phone' => $phone,
            'weight_kg' => $weight_kg,
            'age' => $age,
            'plan_type' => $plan_type,
            'start_date' => $start_date,
            'end_date' => $end_date
        ]);

        // Insert the selected services into the user_services table
        foreach ($services as $service_id) {
            $stmt = $pdo->prepare("INSERT INTO user_services (user_id, service_id) VALUES (:user_id, :service_id)");
            $stmt->execute(['user_id' => $user_id, 'service_id' => $service_id]);
        }

        // Insert payment details into the payments table with pending status
        $stmt = $pdo->prepare("INSERT INTO payments (user_id, amount, payment_status) 
                               VALUES (:user_id, :amount, 'pending')");
        $stmt->execute(['user_id' => $user_id, 'amount' => $payment_amount]);

        // Set success message and message class for success styling
        $_SESSION['message'] = "Registration successful!";
        $_SESSION['message_class'] = "success";

        // Redirect to the registration page with a success message
        header("Location: ../public/register.php");
        exit;
    } catch (PDOException $e) {
        // If an error occurs during database operations, show an error message
        $_SESSION['message'] = "Registration failed. Please try again.";
        $_SESSION['message_class'] = "error"; // CSS class for error styling
        header("Location: ../public/register.php"); // Redirect back to registration page
        exit;
    }
}
?>
