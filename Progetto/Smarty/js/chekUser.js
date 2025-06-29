/**
* Checks if the username is unique.
*/
document.getElementById("username").addEventListener("blur", function () {
    const username = this.value.trim();
    const submitBtn = document.getElementById("submit-modify");
    const inputField = this;

    if (username === "") {
        errorSpan.textContent = "";
        inputField.classList.remove("is-danger");
        submitBtn.disabled = false;
        return;
    }

    fetch("/checkUsername", {
        method: "POST",
        headers: {
            "Content-Type": "application/x-www-form-urlencoded"
        },
        body: "username=" + encodeURIComponent(username)
    })
        .then(res => res.json())
        .then(data => {
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
            errorSpan.textContent = "Errore nel controllo. Riprova.";
            inputField.classList.add("is-danger");
            submitBtn.disabled = true;
        });
});