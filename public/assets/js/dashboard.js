/*
 * dashboard.js
 *
 * This script handles the visibility of the edit form on the dashboard page.
 *
 * Functionality:
 * - `toggleEdit()`: Toggles the visibility of the edit form by adding or removing 
 *   the "hidden" class from the element with the ID "edit-form".
 * - When triggered (e.g., by a button click), it dynamically updates the form's 
 *   visibility state without requiring a page reload.
 *
 * Dependencies:
 * - The edit form must have the ID "edit-form".
 * - The "hidden" class should be defined in CSS to control the display behavior.
 */


function toggleEdit() {
    var form = document.getElementById("edit-form");
    form.classList.toggle("hidden");
}
