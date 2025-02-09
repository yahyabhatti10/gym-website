<!-- /*
 * index.php is the home page of the Health & Fitness website.
 * This file combines common header and footer sections with a unique hero section.
 * It starts by including the header (navigation bar and common top elements)
 * and ends by including the footer (copyright notice and closing HTML tags).
 * The main content is the hero section which displays a welcome message,
 * a brief description of the gym, and a call-to-action button for new members.
 */ -->


<?php
  include('../includes/header.php'); // Include the navbar
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Health & Fitness | Home</title>
  <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
  <div class="hero-section">
  <div class="hero-content">
    <h1>Elevate Your Strength, Transform Your Life</h1>
    <p>Welcome to Health & Fitness, your ultimate destination for a healthier and stronger you! We are dedicated to providing top-notch training, expert guidance, and a supportive community to help you achieve your fitness goals.

    Whether you’re looking to build muscle, lose weight, or enhance your overall well-being, our gym offers the best facilities and professional trainers to keep you motivated.

    Join Health & Fitness today and take the first step towards a better you! </p>
    <a href="register.php" class="btn">Join Now</a>
  </div>
  <div class="hero-image">
    <img src="assets/images/hero-section-image.jpg" alt="Hero Image">
  </div>
</div>
<?php
  include('../includes/footer.php'); // Include the footer
?>
</body>
</html>
