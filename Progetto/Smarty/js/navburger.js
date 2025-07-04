console.log('navburger loaded');

const burger = document.querySelector('#burger'); // take the element with id burger
burger.addEventListener('click', () => {
    // when the user clicks on the burger icon
    const toOpen = document.querySelector('#navbarBasicExample'); // takes the element with id navbarBasicExample
    toOpen.classList.toggle('is-active'); // shows or hides the element by toggling the class is-active of Bulma
});
