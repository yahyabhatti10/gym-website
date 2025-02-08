<?php
session_start();
include('../includes/header.php'); // Include the navbar
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Health & Fitness | Password Recovery</title>
    <link rel="stylesheet" href="assets/css/forgot_password.css">
</head>

<body>
    <div class="signup-section">
        <div class="signup-container">
            <form action="../actions/process_forgotpassword.php" method="POST" class="signup-form">
                <h1>Password Recovery</h1>
                <div class="input-group">
                    <label for="full_name">Full Name</label>
                    <input type="text" name="full_name" id="full_name" required>
                </div>

                <div class="input-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" required>
                </div>

                <div class="input-group">
                    <label for="new_password">New Password</label>
                    <div class="password-wrapper">
                        <input type="password" name="new_password" id="new_password" required>
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
                if (isset($_SESSION['error'])) {
                    echo "<p class='error-message'>" . $_SESSION['error'] . "</p>";
                    unset($_SESSION['error']);
                }
                if (isset($_SESSION['success'])) {
                    echo "<p class='success-message'>" . $_SESSION['success'] . "</p>";
                    unset($_SESSION['success']);
                }
                ?>

                <button type="submit" class="signup-btn">Reset Password</button>

                <p class="login-text">Remembered your password? <a href="login.php">Login</a></p>
            </form>
        </div>
    </div>

    <script src="assets/js/login.js"></script>

    <?php include('../includes/footer.php'); ?>
</body>
</html>
