const login = document.getElementById("login-form");
console.log("login form", login);
const regis = document.getElementById("regis-form");
console.log("regis form", regis);
regis.style.display = 'none'; // Hide registration form by default
const stile = login.style.display;

console.log("porco dio");

function showLogin() {
    if (login && regis) {
        login.style.display = stile;
        regis.style.display = 'none';
    }
}

function showRegis() {
    if (login && regis) {
        regis.style.display = stile;
        login.style.display = 'none';
    }
}