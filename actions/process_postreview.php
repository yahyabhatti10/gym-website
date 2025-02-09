<?php
// Start the session to manage user authentication and error messages
session_start();

// Include the database connection configuration file
include('../includes/config.php');

// Check if the form is submitted using POST method
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if the user is logged in by checking the session for 'user_id'
    if (!isset($_SESSION['user_id'])) {
        // If not logged in, store an error message and redirect to the login page
        $_SESSION['error'] = "You must be logged in to post a review.";
        header("Location: ../public/login.php"); // Redirect to login page
        exit(); // Stop further execution of the script
    }
    
    // Retrieve the user ID from the session and the review text from the POST data
    $user_id = $_SESSION['user_id'];
    $review = trim($_POST['review']);
    
    // Validate that the review is not empty
    if (empty($review)) {
        // If review is empty, store an error message and redirect to the dashboard
        $_SESSION['error'] = "Review cannot be empty.";
        header("Location: ../public/dashboard.php"); // Redirect to dashboard
        exit(); // Stop further execution
    }
    
    try {
        // Prepare the SQL query to insert the review into the database
        $stmt = $pdo->prepare("INSERT INTO reviews (user_id, review) VALUES (:user_id, :review)");
        // Execute the query with the user ID and review data
        $stmt->execute([
            'user_id' => $user_id,
            'review'  => $review
        ]);
        // Set a success message and redirect to the dashboard
        $_SESSION['message'] = "Review posted successfully!";
        $_SESSION['message_class'] = "success-message"; // Optional: CSS class for styling
        header("Location: ../public/dashboard.php"); // Redirect to dashboard
        exit(); // Stop further execution
    } catch (PDOException $e) {
        // If there is an error during the database operation, store an error message and redirect
        $_SESSION['error'] = "Failed to post review. Please try again.";
        header("Location: ../public/dashboard.php"); // Redirect to dashboard
        exit(); // Stop further execution
    }
} else {
    // If the request method is not POST, redirect to the dashboard
    header("Location: ../public/dashboard.php"); // Redirect to dashboard
    exit(); // Stop further execution
}
?>
