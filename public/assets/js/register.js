/*
 * register.js
 *
 * This script is used to dynamically calculate the total amount based on selected checkboxes 
 * on the registration form. Each checkbox represents an item or service with a price attached.
 *
 * Functionality:
 * - Listens for the 'change' event on all checkboxes (typically used for selecting items or options).
 * - When a checkbox is checked or unchecked, it triggers the event handler.
 * - The event handler loops through all checked checkboxes and sums up their data-price values.
 * - The total amount is then displayed in a form field with the id 'payment_amount', formatted to two decimal places.
 *
 * Dependencies:
 * - Each checkbox should have a `data-price` attribute containing the price value associated with the item or service.
 * - The total calculated amount is displayed in an input field with the id 'payment_amount'.
 */


document.querySelectorAll('input[type="checkbox"]').forEach(function (checkbox) {
    checkbox.addEventListener('change', function () {
        let totalAmount = 0;
        document.querySelectorAll('input[type="checkbox"]:checked').forEach(function (checkedBox) {
            totalAmount += parseFloat(checkedBox.getAttribute('data-price'));
        });
        document.getElementById('payment_amount').value = totalAmount.toFixed(2);
    });
});