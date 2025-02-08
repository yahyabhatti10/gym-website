document.addEventListener("DOMContentLoaded", function () {
    const togglePasswordButtons = document.querySelectorAll(".toggle-password");

    togglePasswordButtons.forEach(button => {
        button.addEventListener("click", function () {
            const passwordField = this.previousElementSibling; // Get the input field before the button
            passwordField.type = passwordField.type === "password" ? "text" : "password";
        });
    });
});
