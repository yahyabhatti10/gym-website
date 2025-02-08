document.querySelectorAll('input[type="checkbox"]').forEach(function (checkbox) {
    checkbox.addEventListener('change', function () {
        let totalAmount = 0;
        document.querySelectorAll('input[type="checkbox"]:checked').forEach(function (checkedBox) {
            totalAmount += parseFloat(checkedBox.getAttribute('data-price'));
        });
        document.getElementById('payment_amount').value = totalAmount.toFixed(2);
    });
});