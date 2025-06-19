const login = document.getElementById("login-form");
console.log("login form", login);
const regis = document.getElementById("regis-form");
console.log("regis form", regis);
regis.style.display = 'none'; // Hide registration form by default
const stile = login.style.display;

const log = document.getElementById("log");
const reg = document.getElementById("reg");
console.log("show login", log, reg);

const diolupinterzo = document.getElementById("content");
console.log("diolupinterzo", diolupinterzo);

const inputs = document.querySelectorAll(".input");
console.log("inputs", inputs);

function showLogin() {
    if (login && regis) {
        login.style.display = stile;
        regis.style.display = 'none';
        if (log && reg) {
            log.classList.add("is-active");
            reg.classList.remove("is-active");
        }
        if(diolupinterzo) {
            diolupinterzo.style.width = '30%';
        }
        if(inputs) {
            inputs.forEach(function(input) {
                input.style.width = '100%';
            });
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
        if(diolupinterzo) {
            diolupinterzo.style.width = '40%';
        }
        if(inputs) {
            inputs.forEach(function(input) {
                input.style.width = '45%';
            });
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