let primaEsecuzioneErrori = true;
const div1 = document.getElementById('contenuto-file-errori');

let primaEsecuzioneEventi = true;
const div2 = document.getElementById('contenuto-file-eventi');

console.log('log loaded');

async function aggiornaErrori() {
    fetch('Progetto/Utility/Logs/errors.log')
        .then((res) => res.text())
        .then((text) => {
            div1.innerHTML = text.split('\n');
        })
        .catch((e) => console.error(e));
    if (primaEsecuzioneEventi) {
        div1.scrollTop = div2.scrollHeight;
        primaEsecuzioneEventi = false;
    }
}

async function aggiornaEventi() {
    fetch('Progetto/Utility/Logs/events.log')
        .then((res) => res.text())
        .then((text) => {
            div2.innerHTML = text.split('\n');
        })
        .catch((e) => console.error(e));
    if (primaEsecuzioneEventi) {
        div2.scrollTop = div2.scrollHeight;
        primaEsecuzioneEventi = false;
    }
}

// Prima esecuzione
aggiornaErrori();
aggiornaEventi();

// Ogni 5 secondi (meglio di 1 secondo, più sostenibile)
// 5*60*1000 SONO 5 MINUTI
setInterval(aggiornaErrori, 1 * 1000); // 10 secondi
setInterval(aggiornaEventi, 1 * 1000); // 10 secondi
