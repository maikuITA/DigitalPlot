console.log('log loaded');

function buildText(text) {
    let testo = '';
    text = text.split('\n');
    text.forEach((riga) => {
        testo += riga + '<br>';
    });
    return testo;
}

async function aggiornaErrori() {
    fetch('Progetto/Utility/Logs/errors.log')
        .then((res) => res.text())
        .then((text) => {
            document.getElementById('contenuto-file-errori').innerHTML =
                buildText(text);
        })
        .catch((e) => console.error(e));
}

async function aggiornaEventi() {
    fetch('Progetto/Utility/Logs/events.log')
        .then((res) => res.text())
        .then((text) => {
            document.getElementById('contenuto-file-eventi').innerHTML =
                buildText(text);
        })
        .catch((e) => console.error(e));
}

// Prima esecuzione
aggiornaErrori();
aggiornaEventi();

// Ogni 5 secondi (meglio di 1 secondo, più sostenibile)
// 5*60*1000 SONO 5 MINUTI
setInterval(aggiornaErrori, 10 * 1000); // 10 secondi
setInterval(aggiornaEventi, 10 * 1000); // 10 secondi

document.getElementById('errori-bottom').addEventListener('click', () => {
    const contenutoErrori = document.getElementById('contenuto-file-errori');
    contenutoErrori.scrollTop = contenutoErrori.scrollHeight;
});

document.getElementById('eventi-bottom').addEventListener('click', () => {
    const contenutoEventi = document.getElementById('contenuto-file-eventi');
    contenutoEventi.scrollTop = contenutoEventi.scrollHeight;
});
