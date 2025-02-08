<?php
session_start();
include('../includes/header.php');

// Ensure the message is shown after successful registration
if (!isset($_SESSION['user_id'])) {
  echo '<div class="login-required">
    <p>Login is required to access this page. <a href="login.php">Login here</a></p>
    </div>';
  exit;
}

include('../includes/config.php');

// Fetch the full name from the database based on user ID
$user_id = $_SESSION['user_id'];
$query = "SELECT full_name FROM users WHERE id = :user_id";
$stmt = $pdo->prepare($query);
$stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
$stmt->execute();

$user = $stmt->fetch(PDO::FETCH_ASSOC);

// Check if the user is found
if ($user) {
  $full_name = $user['full_name']; // Get full name from database
} else {
  $full_name = ''; // Default to empty if no user found
}

// Fetch services from database using PDO
$query = "SELECT * FROM services";
$stmt = $pdo->prepare($query);
$stmt->execute();
$services = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Success and error messages
$message = "";
$message_class = "";

if (isset($_SESSION['message'])) {
  $message = $_SESSION['message'];
  $message_class = $_SESSION['message_class'];
  unset($_SESSION['message'], $_SESSION['message_class']);  // Clear message after displaying it
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register for Membership</title>
  <link rel="stylesheet" href="assets/css/register.css">
</head>

<body>
  <div class="register-section">


    <div class="register-container">
      <h1 class="register-title">Become a Member</h1>
      <!-- Show success or error message -->
      <?php if ($message): ?>
        <div class="message <?php echo $message_class; ?>"><?php echo $message; ?></div>
      <?php endif; ?>
      <form action="../actions/process_register.php" method="POST">
        <section>
          <h2>Personal Information</h2>
          <br>
          <label for="full_name">Full Name</label>
          <input type="text" id="full_name" name="full_name" value="<?php echo htmlspecialchars($full_name); ?>" readonly>

          <label for="email">Email</label>
          <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($_SESSION['user_email']); ?>" readonly>

          <label for="phone">Phone</label>
          <input type="text" id="phone" name="phone" required>

          <label for="age">Age</label>
          <input type="number" id="age" name="age" required>

          <label for="weight_kg">Weight (kg)</label>
          <input type="number" id="weight_kg" name="weight_kg" required>
        </section>

        <section>
          <h2>Membership Plan</h2>
          <br>
          <label for="plan_type">Plan Type</label>
          <select id="plan_type" name="plan_type" required>
            <option value="monthly">Monthly</option>
            <option value="yearly">Yearly</option>
          </select>
        </section>

        <section>
          <h2>Additional Services</h2>
          <br>
          <?php foreach ($services as $service): ?>
            <div class="service">
              <label for="service_<?php echo $service['id']; ?>"><?php echo htmlspecialchars($service['service_name']); ?></label>
              <input type="checkbox" id="service_<?php echo $service['id']; ?>" name="services[]" value="<?php echo $service['id']; ?>" data-price="<?php echo $service['price']; ?>">
              <p><?php echo htmlspecialchars($service['description']); ?></p>
              <p>Price: $<?php echo $service['price']; ?></p>
              <br>
            </div>
          <?php endforeach; ?>
        </section>

        <section>
          <h2>Payment</h2>
          <br>
          <label for="payment_amount">Total Amount</label>
          <input type="text" id="payment_amount" name="payment_amount" readonly>

          <button type="submit" name="submit">Register</button>
        </section>
      </form>
    </div>
  </div>

  <?php include('../includes/footer.php'); ?>

  <script src="assets/js/register.js"></script>
</body>

</html>