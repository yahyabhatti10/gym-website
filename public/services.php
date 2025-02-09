<!-- /*
 * services.php is the Services page of the Health & Fitness website.
 * It begins by including a common header file which loads the navigation bar and handles session management.
 * The HTML document is set up with proper meta tags for character encoding, viewport settings, and browser compatibility.
 * A dedicated stylesheet is linked to apply specific styles for this page.
 * The body features a section that displays the gym's services:
 *   - The container holds a section title "Our Services" and a services container.
 *   - Inside the services container, there are three service boxes.
 *     Each service box includes an image, a heading, and a detailed description for:
 *       1. Personal Training
 *       2. Nutrition Plans
 *       3. Group Classes
 * Finally, the common footer is included to maintain a consistent layout across the website.
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
  <title>Health & Fitness | Services</title>
  <link rel="stylesheet" href="assets/css/services.css">
</head>
<body>
  <section class="services-section">
    <div class="container">
      <h2 class="section-title">Our Services</h2>
      <div class="services-container">
        <div class="service-box">
          <img src="assets/images/personal-training.jpg" alt="Personal Training">
          <h3>Personal Training</h3>
          <p>Achieve your fitness goals with expert guidance and a personalized training plan tailored to your needs. Our certified trainers will work with you one-on-one, helping you build strength, improve endurance, and stay motivated every step of the way. Whether you're a beginner or an experienced athlete, we’ll create a program that fits your lifestyle and maximizes your results.</p>
        </div>
        <div class="service-box">
          <img src="assets/images/nutrition-plans.jpeg" alt="Nutrition Plans">
          <h3>Nutrition Plans</h3>
          <p>Fuel your body the right way with customized nutrition plans designed to support your fitness journey. Our expert nutritionists provide meal plans and guidance based on your goals, whether it’s weight loss, muscle gain, or overall well-being. We focus on sustainable, balanced eating habits to help you stay healthy and energized.</p>
        </div>
        <div class="service-box">
          <img src="assets/images/group-classes.jpeg" alt="Group Classes">
          <h3>Group Classes</h3>
          <p>Stay active and have fun with our high-energy group classes. From strength training to cardio workouts, our classes are designed to keep you engaged, motivated, and challenged. Whether you prefer intense boot camps, yoga, or HIIT sessions, our experienced instructors will push you to give your best while enjoying a supportive community.</p>
        </div>
      </div>
    </div>
  </section>
  <?php
  include('../includes/footer.php'); // Include the footer
?>
</body>
</html>
