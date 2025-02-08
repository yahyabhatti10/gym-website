<?php
session_start();

// Check if the user is already logged in
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
    <title>Health & Fitness | Signup</title>
    <link rel="stylesheet" href="assets/css/signup.css">
</head>

<body>
    <div class="signup-section">
        <div class="signup-container">
            <form action="../actions/process_signup.php" method="POST" class="signup-form">
                <h1>Sign Up</h1>
                <div class="input-group">
                    <label for="full_name">Full Name</label>
                    <input type="text" name="full_name" id="full_name" required>
                </div>

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

                <div class="input-group">
                    <label for="confirm_password">Confirm Password</label>
                    <div class="password-wrapper">
                        <input type="password" name="confirm_password" id="confirm_password" required>
                        <span class="toggle-password">👁</span>
                    </div>
                </div>
                <?php
                // Check if there's an error in the session
                if (isset($_SESSION['error'])) {
                    echo "<p class='error-message'>" . $_SESSION['error'] . "</p>";
                    unset($_SESSION['error']); // Clear the error after showing
                }
                ?>

                <button type="submit" class="signup-btn">Sign Up</button>

                <p class="login-text">Already have an account? <a href="login.php">Login</a></p>
            </form>
        </div>
    </div>

    <script src="assets/js/login.js"></script> <!-- Moved JS to external file -->

    <?php include('../includes/footer.php'); ?> <!-- Added footer -->
</body>

</html>
