/**
 * Script for managing user login and registration.
 * Allows showing/hiding the login and registration forms,
 * adapting the style and container width based on the window size.
 */


console.log("accesso loaded");

// Selects the login and registration forms
const login = document.getElementById("login-form");
const regis = document.getElementById("regis-form");
regis.style.display = 'none'; // Hides the registration form on startup
const stile = login.style.display;

// Selects the login and registration buttons/tabs
const log = document.getElementById("log");
const reg = document.getElementById("reg");

// Selects the main container
const content = document.getElementById("content");

// Selects all inputs with the "field" class
const inputs = document.querySelectorAll(".field");

/**
 * Shows the login form and hides the registration form.
 * Updates the tab styles and container width based on the window size.
 */
function showLogin() {
    if (login && regis) {
        login.style.display = stile;
        regis.style.display = 'none';
        if (log && reg) {
            log.classList.add("is-active");
            reg.classList.remove("is-active");
        }

        // Adjusts the width of the content based on the window size
        if (content) {
            if (window.innerWidth > 768) {
                content.style.width = '30%';
            }
            else {
                content.style.width = '100%';
            }
        }
        if (inputs) {
            inputs.forEach(function (input) {
                input.style.display = 'block';
            });
        }
    }
}

/**
 * Shows the registration form and hides the login form.
 * Updates the tab styles and container width based on the window size.
 */
function showRegis() {
    if (login && regis) {
        regis.style.display = stile;
        login.style.display = 'none';
        if (log && reg) {
            log.classList.remove("is-active");
            reg.classList.add("is-active");
        }
        if (content) {
            if (window.innerWidth > 768) {
                content.style.width = '40%';
            }
            else {
                content.style.width = '100%';
            }
        }
        if (inputs) {
            inputs.forEach(function (input) {
                input.style.display = 'block';
            });
        }
    }
}

/**
 * Adds the "is-loading" class to the input with the specified id,
 * useful for showing a loading indicator.
 * @param {string} id - The id of the input element
 */
function loading(id) {
    const input = document.getElementById(id);
    if (input) {
        input.classList.add("is-loading");
    }
}

/**
 * Removes the "is-loading" class from the input with the specified id.
 * @param {string} id - The id of the input element
 */
function notloading(id) {
    const input = document.getElementById(id);
    if (input) {
        input.classList.remove("is-loading");
    }
}


// Adjusts the main container width when the window is resized
window.addEventListener('resize', function () {
    if (login && regis) {
        if (login.style.display === stile) {
            content.style.width = window.innerWidth > 768 ? '30%' : '100%';
        } else if (regis.style.display === stile) {
            content.style.width = window.innerWidth > 768 ? '40%' : '100%';
        }
    }
});



/**
 * Checks if the username is unique.
 */
document.getElementById("usernameR").addEventListener("blur", function () {
    const username = this.value.trim();
    const submitBtn = document.getElementById("submit-regis");
    const inputField = this;

    // the content type tells to the server that the body contains value in the 'query string' format
    fetch("/checkUsername", {
        method: "POST",
        headers: {
            "Content-Type": "application/x-www-form-urlencoded"
        },
        body: "username=" + encodeURIComponent(username)
    })
        .then(res => res.json()) // converts the response to JSON
        .then(data => { // data refers to the JSON object returned by the server
            if (data.exists === true) {
                inputField.classList.add("is-danger");
                submitBtn.disabled = true;
            } else {
                inputField.classList.remove("is-danger");
                submitBtn.disabled = false;
            }
        })
        .catch(error => {
            console.error("Errore nella verifica username:", error);
            inputField.classList.add("is-danger");
            submitBtn.disabled = true;
        });
});
