<!-- /*
 * about.php displays the "About Us" page for the Health & Fitness website.
 * It begins by including the header, which provides the navigation bar and handles session management.
 * The HTML structure includes meta tags for character set, viewport, and compatibility,
 * a title for the page, and a link to a CSS file specific to the About page.
 * The body contains an "about-container" that holds an "about-card".
 * This card displays a banner image and detailed content explaining the gym's mission, identity, and community.
 * At the end of the page, the footer is included to provide a consistent bottom section.
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
    <title>Health & Fitness | About</title>
    <link rel="stylesheet" href="assets/css/about.css">
</head>

<body>
    <div class="about-container">
        <div class="about-card">
            <img src="assets/images/about-us.png" alt="Gym Banner" class="about-banner">

            <div class="about-content">
                <h1>About Us</h1>

                <h2>Our Mission</h2>
                <p>At Health & Fitness, our vision is to empower individuals to achieve their best physical and mental well-being. We believe in creating a supportive community where fitness becomes a lifestyle rather than a challenge.</p>

                <h2>Who We Are</h2>
                <p>We are a state-of-the-art gym dedicated to providing the best workout experience. With cutting-edge equipment, professional trainers, and a motivating atmosphere, we help our members push their limits and reach new heights.</p>

                <h2>Why Choose Us?</h2>
                <p>We offer personalized training programs, modern fitness classes, and expert guidance. Whether you are a beginner or a seasoned athlete, Health & Fitness is the perfect place to transform your body and mind.</p>

                <h2>Join Our Community</h2>
                <p>Become a part of our fitness family and take the first step towards a healthier and stronger you. Your journey to greatness starts here!</p>
            </div>
        </div>
    </div>

    <?php include('../includes/footer.php'); // Include the footer 
    ?>
</body>

</html>