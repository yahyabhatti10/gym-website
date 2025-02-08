<?php
session_start();

// // Check if the user is already logged in
if (isset($_SESSION['user_id'])) {
    header("Location: ../public/index.php"); // Redirect to homepage or dashboard
    exit();
}

include('../includes/header.php'); // Include the navbar
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
            <form action="../actions/process_login.php" method="POST" class="login-form">
                <h1>Sign In</h1>

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

                <?php
                // Check if there's an error message in the session and display it
                if (isset($_SESSION['error'])) {
                    echo "<p class='error-message'>" . $_SESSION['error'] . "</p>";
                    unset($_SESSION['error']); // Clear the error after showing
                }
                ?>

                <button type="submit" class="login-btn">Login</button>

                <div class="options">
                    <a href="forgot_password.php">Forgot Password?</a>
                </div>

                <p class="signup-text">Don't have an account? <a href="signup.php">Sign Up</a></p>
            </form>
        </div>
    </div>

    <script src="assets/js/login.js"></script> >

    <?php include('../includes/footer.php'); ?> <!-- Added footer -->
</body>

</html>
