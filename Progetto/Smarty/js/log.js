console.log('log loaded');

function buildText(text) {
    let testo = '';
    text = text.split('\n');
    text.forEach((riga) => {
        if (riga.trim() !== '') {
            testo += riga + '<br>';
        }
    });
    console.log(testo);
    return testo;
}

async function aggiornaErrori() {
    console.log('Aggiorno errori');
    fetch('Progetto/Utility/Logs/errors.log')
        .then((res) => res.text())
        .then((text) => {
            console.log(text);
            document.getElementById('contenuto-file-errori').innerHTML =
                buildText(text);
        })
        .catch((e) => console.error(e));
}

async function aggiornaEventi() {
    console.log('Aggiorno eventi');
    fetch('Progetto/Utility/Logs/events.log')
        .then((res) => res.text())
        .then((text) => {
            console.log(text);
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
setInterval(aggiornaErrori, 1 * 1000); // 10 secondi
setInterval(aggiornaEventi, 1 * 1000); // 10 secondi
