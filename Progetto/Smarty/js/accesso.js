const login = document.getElementById("login-form");
//console.log("login form", login);
const regis = document.getElementById("regis-form");
//console.log("regis form", regis);
regis.style.display = 'none'; // Hide registration form by default
const stile = login.style.display;

const log = document.getElementById("log");
const reg = document.getElementById("reg");
//console.log("show login", log, reg);

const content = document.getElementById("content");
//console.log("content", content);

const inputs = document.querySelectorAll(".field");
//console.log("inputs", inputs);

function showLogin() {
    if (login && regis) {
        login.style.display = stile;
        regis.style.display = 'none';
        if (log && reg) {
            log.classList.add("is-active");
            reg.classList.remove("is-active");
        }
        if(content) {
            if(window.innerWidth > 768) {
                content.style.width = '30%';
            }
            else {
                content.style.width = '100%';
            }
        }
        if(inputs) {
            inputs.forEach(function(input) {
                input.style.display = 'block';
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
        if(content) {
            if(window.innerWidth > 768) {
                content.style.width = '40%';
            }
            else {
                content.style.width = '100%';
            }
        }
        if(inputs) {
            if(window.innerWidth > 768) {
                content.style.width = '40%';
                inputs.forEach(function(input) {
                    input.style.display = 'block';
                });
            }
            else {
                content.style.width = '100%';
                inputs.forEach(function(input) {
                    input.style.display = 'block';
                });
            }
            
        }
    }
}

function loading(id) {
    //console.log(id);
    const input = document.getElementById(id);
    if (input) {
        input.classList.add("is-loading");
    }
}

function notloading(id) {
    //console.log(id);
    const input = document.getElementById(id);
    if (input) {
        input.classList.remove("is-loading");
    }
}

window.addEventListener('resize', function() {
    if (login && regis) {
        if (login.style.display === stile) {
            content.style.width = window.innerWidth > 768 ? '30%' : '100%';
        } else if (regis.style.display === stile) {
            content.style.width = window.innerWidth > 768 ? '40%' : '100%';
        }
    }
});