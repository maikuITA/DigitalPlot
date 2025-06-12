const myNav = document.querySelector("#navbar")
const burger = document.querySelector("#burger")
burger.addEventListener('click', ()=> {
    const toOpen = document.querySelector("#dropdown")
    toOpen.classList.toggle("is-active")
})
