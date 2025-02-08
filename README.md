# Health & Fitness Gym Website

## Overview

Gym Website is a full-stack web application built from scratch. The frontend is developed using HTML, CSS, and JavaScript, while the backend is powered by PHP with a MySQL database. This application allows users to sign up, log in, manage their gym memberships, view and update personal and membership information, and post reviews. The project is designed to run on a local server (using XAMPP) and demonstrates essential web development practices, including environment variable management and modular code structure.

## Working Tree Structure

Below is the folder structure for the project:

```
gym-website
|   .env
|   .gitignore
|   README.md
|   
+---actions
|       process_forgotpassword.php
|       process_login.php
|       process_logout.php
|       process_postreview.php
|       process_register.php
|       process_signup.php
|       process_update.php
|       
+---database
|       gym_website_db.sql
|       
+---includes
|       config.php
|       footer.php
|       header.php
|       
\---public
    |   about.php
    |   dashboard.php
    |   forgot_password.php
    |   index.php
    |   login.php
    |   register.php
    |   services.php
    |   signup.php
    |   test_db_connection.php
    |   
    \---assets
        +---css
        |       about.css
        |       dashboard.css
        |       footer.css
        |       forgot_password.css
        |       header.css
        |       login.css
        |       register.css
        |       services.css
        |       signup.css
        |       style.css
        |       
        +---images
        |       about-us.png
        |       group-classes.jpeg
        |       hero-section-image.jpg
        |       nutrition-plans.jpeg
        |       personal-training.jpg
        |       
        \---js
                dashboard.js
                login.js
                register.js
```

## Requirements

- **XAMPP**: Install XAMPP (or a similar local server environment) to run Apache and MySQL.
- **PHP**: Version 7.x or above is recommended.
- **MySQL**: To create and manage the database.

## Setup Instructions

### Step 1: Clone the Project

1. Clone the repository to your local machine using `git clone https://github.com/yahyabhatti10/gym-website.git`.
2. Extract or copy the project folder (`gym-website`) into the `htdocs` folder of your XAMPP installation.

### Step 2: Start the Server

1. Open the XAMPP Control Panel.
2. Start **Apache** and **MySQL** servers.

### Step 3: Create the Database

1. Open your browser and navigate to `http://localhost/phpmyadmin`.
2. Create a new database named `gym_website_db`.

### Step 4: Test the Database Connection

1. In your browser, go to `http://localhost/gym-website/public/test_db_connection.php`.
2. You should see a message indicating that the database connection is successful.
3. If not, verify that your MySQL server is running, that the credentials in `includes/config.php` are correct, and that the database `gym_website_db` exists.

### Step 5: Import the Database Schema

1. In phpMyAdmin, select the `gym_website_db` database.
2. Click on the **Import** tab.
3. Choose the `gym_website_db.sql` file from the `gym-website/database/` folder.
4. Click **Go** to run the queries and create the necessary tables.
5. Verify from the sidebar that the following tables have been created:
   - `users`
   - `memberships`
   - `services`
   - `user_services`
   - `payments`
   - `reviews`

### Step 6: Run the Application

1. Open a command prompt and navigate to `C:\xampp\php`.
2. Run the following command to start a PHP built-in server:
   ```bash
   php -S localhost:8000 -t C:\xampp\htdocs\gym-website\public
   ```
3. Open your browser and go to `http://localhost:8000`.
4. The website should load. You can now navigate to **Login** or **Signup** to create an account and explore the features.

### Step 7: Explore the Features

- **Sign Up/Sign In**: Create an account using the **Signup** and **Login** pages.
- **Membership Registration**: After logging in, navigate to the **Register** page to fill out your membership details.
- **Dashboard**: View and update your personal and membership information, post reviews, and view all reviews.
- **Forgot Password**: Use the password recovery feature if needed.
- **Admin Dashboard**: Manage memberships, reviews, and more.

## Conclusion

This project demonstrates a full-stack Gym Website built using HTML, CSS, and JavaScript on the frontend and PHP on the backend. With functionalities such as user authentication, membership management, review posting, and a fully responsive design, it serves as an excellent example of building a web application from scratch.

Happy Coding!
