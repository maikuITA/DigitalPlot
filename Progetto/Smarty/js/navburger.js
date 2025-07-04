console.log("navburger loaded")

const burger = document.querySelector("#burger") // take the element with id burger
burger.addEventListener('click', () => { // when the user clicks on the burger icon
    const toOpen = document.querySelector("#navbarBasicExample") // takes the element with id navbarBasicExample
    toOpen.classList.toggle("is-active")  // shows or hides the element by toggling the class is-active of Bulma
    if (mobile) {
        mobile.style.display = mobile.style.display === "none" ? "block" : "none"
    }
    if (find) {
        find.style.display = find.style.display === "none" ? "block" : "none"
    }
    if (logout) {
        logout.style.display = logout.style.display === "none" ? "block" : "none"
    }
})