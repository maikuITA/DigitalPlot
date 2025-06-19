const burger = document.querySelector("#burger")
burger.addEventListener('click', ()=> {
    const toOpen = document.querySelector("#navbarBasicExample")
    toOpen.classList.toggle("is-active")
})