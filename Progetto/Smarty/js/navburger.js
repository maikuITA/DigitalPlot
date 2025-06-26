console.log("navburger loaded")

const burger = document.querySelector("#burger")
burger.addEventListener('click', ()=> {
    const toOpen = document.querySelector("#navbarBasicExample")
    toOpen.classList.toggle("is-active")
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