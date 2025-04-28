console.log("[!] Sono nello script.");

const body = document.body;
const header = document.querySelector('header');
const cambiaTema = document.getElementById('cambiaTema');
const logo = document.querySelector('.digilogo');
const bottoneTema = document.querySelector('.fi-ts-lightbulb-on');
const bottoneCerca = document.querySelector('.fi-ts-issue-loupe');
const labelContainer = document.querySelector('Lcontainer');

let isDarkMode = 0;
cambiaTema.addEventListener('click', () => {
    body.classList.toggle('dark-mode');
    header.classList.toggle('dark-mode');
    bottoneTema.classList.toggle('dark-mode');
    bottoneCerca.classList.toggle('dark-mode');
    labelContainer.classList.toggle('dark-mode');
    if(isDarkMode == 0) {
        logo.src = 'digitalplot_dark.png';
        isDarkMode = 1;
    } else {
        logo.src = 'digitalplot.png';
        isDarkMode = 0;
    }
});