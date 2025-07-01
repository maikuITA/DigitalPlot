console.log('validate-expirationDate loaded');

document.addEventListener('DOMContentLoaded', function () {
    const expirationDateInput = document.getElementById('expirationDate');
    const feedbackExpiry = document.getElementById('feedback-expiry');

    expirationDateInput.addEventListener('change', function () {
        const today = new Date();
        const selectedDate = new Date(this.value);

        // set today to the first day of the next month
        today.setMonth(today.getMonth() + 1);
        today.setDate(1);
        today.setHours(0, 0, 0, 0);

        selectedDate.setHours(0, 0, 0, 0);

        if (selectedDate <= today) {
            feedbackExpiry.textContent = 'La carta è scaduta';
            feedbackExpiry.style.color = 'red';
            // feedback, it avoids form submission if the date is invalid
            this.setCustomValidity('Data di scadenza non valida.');
        } else {
            feedbackExpiry.textContent = 'Data di scadenza valida.';
            feedbackExpiry.style.color = 'green';
            // the error messae in empty, the submit botton works 
            this.setCustomValidity('');
        }
    });


});