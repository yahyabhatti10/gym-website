<!-- header.php -->

<!-- /*
 * header.php provides the common header and navigation for the gym website.
 * It first checks if a session has been started; if not, it starts a new session.
 * The file then outputs the HTML head section with meta tags, a link to the header stylesheet,
 * and a Google Font for styling.
 * The navigation bar uses an input checkbox to toggle a responsive sidebar menu.
 * It includes links to key pages like Home, About, Services, and Become a Member.
 * Depending on whether a user is logged in (checked via a session variable), it conditionally displays
 * a Dashboard link (for logged-in users) or a Login link (for guests).
 */ -->

<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="assets/css/header.css">
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
</head>
<body>
  <nav>
    <input type="checkbox" id="sidebar-active">
    <label for="sidebar-active" class="open-sidebar-button">
      <svg xmlns="http://www.w3.org/2000/svg" height="32" viewBox="0 -960 960 960" width="32">
        <path d="M120-240v-80h720v80H120Zm0-200v-80h720v80H120Zm0-200v-80h720v80H120Z"/>
      </svg>
    </label>
    <label id="overlay" for="sidebar-active"></label>
    
    <div class="links-container">
      <label for="sidebar-active" class="close-sidebar-button">
        <svg xmlns="http://www.w3.org/2000/svg" height="32" viewBox="0 -960 960 960" width="32">
          <path d="m256-200-56-56 224-224-224-224 56-56 224 224 224-224 56 56-224 224 224 224-56 56-224-224-224 224Z"/>
        </svg>
      </label>

      <!-- Logo & Home Link -->
      <a class="home-link" href="index.php">Health & Fitness</a> 

      <!-- Navigation Links -->
      <a href="index.php">Home</a> 
      <a href="about.php">About</a>
      <a href="services.php">Services</a>
      <a href="register.php">Become a Member</a>

      <?php if (isset($_SESSION['user_id'])): ?>
          <!-- If user is logged in, show Dashboard & Logout -->
          <a href="dashboard.php">Dashboard</a>
      <?php else: ?>
          <!-- If user is NOT logged in, show Login -->
          <a href="login.php">Login</a>
      <?php endif; ?>
    </div>
  </nav>
</body>
</html>
