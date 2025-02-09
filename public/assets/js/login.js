/*
 * login.js
 *
 * This script enhances the login form by allowing users to toggle the visibility 
 * of their password input fields.
 *
 * Functionality:
 * - Waits for the DOM to fully load before executing.
 * - Selects all elements with the class "toggle-password" (usually eye icons/buttons).
 * - Adds a click event listener to each toggle button.
 * - When clicked, it toggles the input field's type between "password" and "text", 
 *   allowing users to see or hide their password.
 *
 * Dependencies:
 * - The password input field must be placed before the toggle button in the HTML structure.
 * - The toggle button should have the class "toggle-password".
 */


document.addEventListener("DOMContentLoaded", function () {
    const togglePasswordButtons = document.querySelectorAll(".toggle-password");

    togglePasswordButtons.forEach(button => {
        button.addEventListener("click", function () {
            const passwordField = this.previousElementSibling; // Get the input field before the button
            passwordField.type = passwordField.type === "password" ? "text" : "password";
        });
    });
});
