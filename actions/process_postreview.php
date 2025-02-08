<?php
session_start();
include('../includes/config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_SESSION['user_id'])) {
        $_SESSION['error'] = "You must be logged in to post a review.";
        header("Location: ../public/login.php");
        exit();
    }
    
    $user_id = $_SESSION['user_id'];
    $review = trim($_POST['review']);
    
    if (empty($review)) {
        $_SESSION['error'] = "Review cannot be empty.";
        header("Location: ../public/dashboard.php");
        exit();
    }
    
    try {
        $stmt = $pdo->prepare("INSERT INTO reviews (user_id, review) VALUES (:user_id, :review)");
        $stmt->execute([
            'user_id' => $user_id,
            'review'  => $review
        ]);
        $_SESSION['message'] = "Review posted successfully!";
        $_SESSION['message_class'] = "success-message";
        header("Location: ../public/dashboard.php");
        exit();
    } catch (PDOException $e) {
        $_SESSION['error'] = "Failed to post review. Please try again.";
        header("Location: ../public/dashboard.php");
        exit();
    }
} else {
    header("Location: ../public/dashboard.php");
    exit();
}
?>
