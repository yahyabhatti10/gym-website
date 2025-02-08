<?php
session_start();
include('../includes/config.php');

if (!isset($_SESSION['user_id'])) {
    header('Location: /public/login.php');
    exit();
}

$user_id = $_SESSION['user_id'];

$query = "SELECT * FROM users WHERE id = ?";
$stmt = $pdo->prepare($query);
$stmt->bindParam(1, $user_id, PDO::PARAM_INT);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);

$query_membership = "SELECT * FROM memberships WHERE user_id = ?";
$stmt_membership = $pdo->prepare($query_membership);
$stmt_membership->bindParam(1, $user_id, PDO::PARAM_INT);
$stmt_membership->execute();
$membership = $stmt_membership->fetch(PDO::FETCH_ASSOC);

// Query to get the payment information
$query_payment = "SELECT amount FROM payments WHERE user_id = ? ORDER BY payment_date DESC LIMIT 1";
$stmt_payment = $pdo->prepare($query_payment);
$stmt_payment->bindParam(1, $user_id, PDO::PARAM_INT);
$stmt_payment->execute();
$payment = $stmt_payment->fetch(PDO::FETCH_ASSOC);

include('../includes/header.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="assets/css/dashboard.css">
</head>

<body>
    <?php
    if (isset($_GET['status'])) {
        if ($_GET['status'] == 'success') {
            echo '<p class="success-message">Changes saved successfully!</p>';
        } elseif ($_GET['status'] == 'error') {
            echo '<p class="error-message">Failed to save changes. Please try again.</p>';
        }
    }
    ?>

    <div class="dashboard-container">
        <div class="content-wrapper">
            <div class="card">
                <h2>Personal Information</h2>
                <p><strong>Full Name:</strong> <?php echo htmlspecialchars($user['full_name']); ?></p>
                <p><strong>Email:</strong> <?php echo htmlspecialchars($user['email']); ?></p>
            </div>

            <?php if ($membership): ?>
                <div class="card">
                    <h2>Membership Information</h2>
                    <p><strong>Phone:</strong> <?php echo htmlspecialchars($membership['phone']); ?></p>
                    <p><strong>Weight:</strong> <?php echo htmlspecialchars($membership['weight_kg']); ?> kg</p>
                    <p><strong>Age:</strong> <?php echo htmlspecialchars($membership['age']); ?> years</p>
                    <p><strong>Plan Type:</strong> <?php echo htmlspecialchars($membership['plan_type']); ?></p>

                    <!-- Displaying payment amount from payments table -->
                    <?php if ($payment): ?>
                        <p><strong>Payment Amount:</strong> $<?php echo htmlspecialchars($payment['amount']); ?></p>
                    <?php else: ?>
                        <p><strong>Payment Amount:</strong> Not available</p>
                    <?php endif; ?>

                    <p><strong>Status:</strong> <?php echo htmlspecialchars($membership['status']); ?></p>
                </div>

                <div class="card">
                    <button class="edit-btn" onclick="toggleEdit()">Edit Membership</button>
                    <form action="../actions/process_update.php" method="POST" id="edit-form" class="hidden">
                        <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
                        <input type="text" name="phone" value="<?php echo htmlspecialchars($membership['phone']); ?>" required>
                        <input type="number" name="weight_kg" value="<?php echo htmlspecialchars($membership['weight_kg']); ?>" required>
                        <input type="number" name="age" value="<?php echo htmlspecialchars($membership['age']); ?>" required>
                        <select name="plan_type" required>
                            <option value="monthly" <?php echo $membership['plan_type'] == 'monthly' ? 'selected' : ''; ?>>Monthly</option>
                            <option value="yearly" <?php echo $membership['plan_type'] == 'yearly' ? 'selected' : ''; ?>>Yearly</option>
                        </select>
                        <button type="submit">Save Changes</button>
                    </form>
                </div>

            <?php else: ?>
                <div class="card">
                    <h2>No Active Membership</h2>
                    <p>You haven't unlocked your fitness journey yet! <a class="become-a-member-link" href="register.php">Become a member</a> and start training like a champion.</p>
                </div>
            <?php endif; ?>

            <form action="../actions/process_logout.php" method="POST">
                <button type="submit" class="logout-btn">Logout</button>
            </form>
        </div>
    </div>
    <script src="assets/js/dashboard.js"></script>
    <?php
    include('../includes/footer.php');
    ?>
</body>

</html>