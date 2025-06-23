document.addEventListener('DOMContentLoaded', function () {
    const expiryInput = document.getElementById('expirationDate');
    const errorMsg = document.getElementById('error-msg');

    if (expiryInput) {
        expiryInput.addEventListener('change', function () {
            const inputDate = new Date(this.value);
            const today = new Date();
            today.setHours(0, 0, 0, 0);

            if (isNaN(inputDate.getTime())) {
                errorMsg.textContent = "Data non valida.";
                this.setCustomValidity("Data non valida.");
            } else if (inputDate < today) {
                errorMsg.textContent = "La carta è scaduta.";
                this.setCustomValidity("La carta è scaduta.");
            } else {
                errorMsg.textContent = "";
                this.setCustomValidity("");
            }
        });
    }
});
