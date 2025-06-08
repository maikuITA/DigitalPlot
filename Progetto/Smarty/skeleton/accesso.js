const login = document.getElementById("login-form");
console.log("login form", login);
const regis = document.getElementById("regis-form");
console.log("regis form", regis);
regis.style.display = 'none'; // Hide registration form by default
const stile = login.style.display;

const log = document.getElementById("log");
const reg = document.getElementById("reg");
console.log("show login", log, reg);

function showLogin() {
    if (login && regis) {
        login.style.display = stile;
        regis.style.display = 'none';
        if (log && reg) {
            log.classList.add("is-active");
            reg.classList.remove("is-active");
        }
    }
}

function showRegis() {
    if (login && regis) {
        regis.style.display = stile;
        login.style.display = 'none';
        if (log && reg) {
            log.classList.remove("is-active");
            reg.classList.add("is-active");
        }
    }
}

function loading(id) {
    console.log(id);
    const input = document.getElementById(id);
    if (input) {
        input.classList.add("is-loading");
    }
}

function notloading(id) {
    console.log(id);
    const input = document.getElementById(id);
    if (input) {
        input.classList.remove("is-loading");
    }
}