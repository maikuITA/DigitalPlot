console.log('log loaded');

async function buildText(text) {
    let testo = '';
    text = text.split('\n'); // Split the text into lines and remove \n
    text.forEach((riga) => {
        testo += riga + '<br>';
    });
    return testo;
}

// it reads the file errors.log and inserts the content into the div with id 'contenuto-file-errori'
async function aggiornaErrori() {
    await fetch('Progetto/Utility/Logs/errors.log')
        .then((res) => res.text())
        .then((text) => {
            document.getElementById('contenuto-file-errori').innerHTML =
                buildText(text);
        })
        .catch((e) => console.error(e));
}

// it reads the file events.log and inserts the content into the div with id 'contenuto-file-eventi'
async function aggiornaEventi() {
    await fetch('Progetto/Utility/Logs/events.log')
        .then((res) => res.text())
        .then((text) => {
            document.getElementById('contenuto-file-eventi').innerHTML =
                buildText(text);
        })
        .catch((e) => console.error(e));
}

// first execution
aggiornaErrori();
aggiornaEventi();

// set Interval to update the files every 2 minutes
setInterval(aggiornaErrori, 2 * 60 * 1000); // 2 min
setInterval(aggiornaEventi, 2 * 60 * 1000); // 2 min

document.getElementById('errori-bottom').addEventListener('click', () => { // button to reach the end of the errors log
    const contenutoErrori = document.getElementById('contenuto-file-errori');
    contenutoErrori.scrollTop = contenutoErrori.scrollHeight;
});

document.getElementById('eventi-bottom').addEventListener('click', () => {
    const contenutoEventi = document.getElementById('contenuto-file-eventi');
    contenutoEventi.scrollTop = contenutoEventi.scrollHeight; // moves the pointer to the end of the content
});
