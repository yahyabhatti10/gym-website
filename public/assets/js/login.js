document.addEventListener("DOMContentLoaded", function () {
    const togglePassword = document.querySelector(".toggle-password");
    const passwordField = document.getElementById("password");

    togglePassword.addEventListener("click", function () {
        if (passwordField.type === "password") {
            passwordField.type = "text";
        } else {
            passwordField.type = "password";
        }
    });
});
