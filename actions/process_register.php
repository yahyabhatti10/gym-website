<?php
session_start();
include('../includes/config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Fetch form data
    $user_id = $_SESSION['user_id'];
    $phone = $_POST['phone'];
    $weight_kg = $_POST['weight_kg'];
    $age = $_POST['age'];
    $plan_type = $_POST['plan_type'];
    $services = isset($_POST['services']) ? $_POST['services'] : [];
    
    // Age validation
    if ($age < 15) {
        $_SESSION['message'] = "Age must be greater than 15.";
        $_SESSION['message_class'] = "error";
        header("Location: ../public/register.php");
        exit;
    }

    // Default payment calculation
    if ($plan_type === 'monthly') {
        $payment_amount = 40;
    } else {
        $payment_amount = 400;  // Yearly plan default payment
    }

    // Add service prices to total payment
    $total_service_price = 0;
    foreach ($services as $service_id) {
        $stmt = $pdo->prepare("SELECT price FROM services WHERE id = :id");
        $stmt->execute(['id' => $service_id]);
        $service = $stmt->fetch(PDO::FETCH_ASSOC);
        $total_service_price += $service['price'];
    }

    // Adjust the payment for the selected plan (monthly/yearly) and add-ons
    if ($plan_type === 'Monthly') {
        $payment_amount += $total_service_price;
    } else {
        $payment_amount += $total_service_price * 10;  // Multiply add-on price by 10 for yearly plan
    }

    // Calculate start and end date based on plan type
    $start_date = date('Y-m-d');
    if ($plan_type === 'monthly') {
        $end_date = date('Y-m-d', strtotime("+1 month"));
    } else {
        $end_date = date('Y-m-d', strtotime("+1 year"));
    }

    // Insert membership details into the database
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

    // Insert selected services into the database
    foreach ($services as $service_id) {
        $stmt = $pdo->prepare("INSERT INTO user_services (user_id, service_id) VALUES (:user_id, :service_id)");
        $stmt->execute(['user_id' => $user_id, 'service_id' => $service_id]);
    }

    // Insert payment details into the database
    $stmt = $pdo->prepare("INSERT INTO payments (user_id, amount, payment_status) 
                           VALUES (:user_id, :amount, 'pending')");
    $stmt->execute(['user_id' => $user_id, 'amount' => $payment_amount]);

    // Set success message
    $_SESSION['message'] = "Registration successful!";
    $_SESSION['message_class'] = "success";

    // Redirect to the registration page with the success message
    header("Location: ../public/register.php");
    exit;
}
?>
