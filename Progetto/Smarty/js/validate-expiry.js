console.log("porco dio");

document.addEventListener('DOMContentLoaded', function() {
  const form = document.querySelector('form.form');
  const expiryInput = document.getElementById('expirationDate');
  const errorMsg = document.getElementById('error-msg');

  form.addEventListener('submit', function(event) {
    const inputDate = new Date(expiryInput.value);
    const today = new Date();
    today.setHours(0, 0, 0, 0);  // azzera orario per confronto solo su data

    if (!expiryInput.value || isNaN(inputDate.getTime())) {
      errorMsg.textContent = "Per favore inserisci una data valida.";
      expiryInput.setCustomValidity("Data non valida");
      event.preventDefault();
      return;
    } 
    
    if (inputDate < today) {
      errorMsg.textContent = "La carta è scaduta.";
      expiryInput.setCustomValidity("La carta è scaduta");
      event.preventDefault();
      return;
    }

    // Se tutto ok, resetta messaggi e validità
    errorMsg.textContent = "";
    expiryInput.setCustomValidity("");
  });
});

