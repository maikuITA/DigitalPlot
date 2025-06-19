console.log("Pagamento script loaded");

const paypal = document.getElementById("paypal");
const card = document.getElementById("card");

const fatturazione = document.getElementById("fatturazione");
const paypalsubmit = document.getElementById("paypal-submit");

function togglePaymentMethod() {
    if (paypal.checked) {
        card.checked = false;
        fatturazione.style.display = "none";
        paypalsubmit.style.display = "flex";
    } else {
        card.checked = true;
        fatturazione.style.display = "flex";
        paypalsubmit.style.display = "none";
    }
}