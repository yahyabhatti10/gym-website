<?php
include('../includes/header.php'); // Include the navbar
session_start();
include('../includes/config.php'); // Database connection file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $email = trim($_POST['email']);
  $password = trim($_POST['password']);

  // Query to check user credentials
  $query = "SELECT * FROM users WHERE email = ?";
  $stmt = $conn->prepare($query);
  $stmt->bind_param("s", $email);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows == 1) {
    $user = $result->fetch_assoc();
    if (password_verify($password, $user['password'])) {
      $_SESSION['user_id'] = $user['id'];
      $_SESSION['user_email'] = $user['email'];
      header("Location: dashboard.php"); // Redirect to dashboard after login
      exit();
    } else {
      $error = "Invalid email or password!";
    }
  } else {
    $error = "Invalid email or password!";
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Health & Fitness | Login</title>
  <link rel="stylesheet" href="assets/css/login.css">
</head>

<body>
  <div class="login-section">
    <div class="login-container">
      <form action="login.php" method="POST" class="login-form">
        <h1>Sign In</h1>

        <?php if (!empty($error)) {
          echo "<p class='error'>$error</p>";
        } ?>

        <div class="input-group">
          <label for="email">Email</label>
          <input type="email" name="email" id="email" required>
        </div>

        <div class="input-group">
          <label for="password">Password</label>
          <div class="password-wrapper">
            <input type="password" name="password" id="password" required>
            <span class="toggle-password">👁</span>
          </div>
        </div>

        <button type="submit" class="login-btn">Login</button>

        <div class="options">
          <a href="forgot-password.php">Forgot Password?</a>
        </div>

        <p class="signup-text">Not have an account? <a href="signup.php">Sign Up</a></p>
      </form>
    </div>
  </div>

  <script src="assets/js/login.js"></script> <!-- Moved JS to external file -->

  <?php include('../includes/footer.php'); ?> <!-- Added footer -->
</body>

</html>