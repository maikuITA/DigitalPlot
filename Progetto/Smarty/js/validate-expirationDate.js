console.log('validate-expirationDate loaded');

document.addEventListener('DOMContentLoaded', function () {
    const expirationDateInput = document.getElementById('expirationDate');
    const feedbackExpiry = document.getElementById('feedback-expiry');

    expirationDateInput.addEventListener('change', function () {
        const today = new Date();
        const selectedDate = new Date(this.value); // Il valore di input[type="month"] è "YYYY-MM"


        today.setMonth(today.getMonth() + 1);
        today.setDate(1); // Imposta il giorno al primo del mese corrente
        today.setHours(0, 0, 0, 0); // Azzera l'ora per confronti precisi

        selectedDate.setHours(0, 0, 0, 0); // Azzera l'ora

        if (selectedDate <= today) {
            feedbackExpiry.textContent = 'La carta è scaduta';
            feedbackExpiry.style.color = 'red';
            // Impedisce l'invio del form se la data non è valida
            this.setCustomValidity('Data di scadenza non valida.');
        } else {
            feedbackExpiry.textContent = 'Data di scadenza valida.';
            feedbackExpiry.style.color = 'green';
            this.setCustomValidity(''); // Rimuove il messaggio di errore personalizzato
        }
    });

    // ... il resto del tuo codice JavaScript per la validazione della carta ...
    // Assicurati che questo codice sia all'interno del listener DOMContentLoaded
});