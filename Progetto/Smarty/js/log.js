let primaEsecuzioneErrori = true;
let primaEsecuzioneEventi = true;

async function aggiornaErrori() {
    try {
        const response = await fetch('/Progetto/Utility/ULeggiErrori.php?t=' + new Date().getTime(), {
            cache: "no-store"
        });

        if (!response.ok) throw new Error('Errore nella richiesta: ' + response.status);

        const testo = await response.text();
        const div1 = document.getElementById("contenuto-file-errori");

        if (div1 && testo.trim()) {
            div1.innerHTML = testo;

            if (primaEsecuzioneErrori) {
                div1.scrollTop = div1.scrollHeight;
                primaEsecuzioneErrori = false;
            }
        }
    } catch (err) {
        console.error('Errore durante il caricamento degli errori:', err);
    }
}

async function aggiornaEventi() {
    try {
        const response = await fetch('/Progetto/Utility/ULeggiEventi.php?t=' + new Date().getTime(), {
            cache: "no-store"
        });

        if (!response.ok) throw new Error('Errore nella richiesta: ' + response.status);

        const testo = await response.text();
        const div2 = document.getElementById("contenuto-file-eventi");

        if (div2 && testo.trim()) {
            div2.innerHTML = testo;

            if (primaEsecuzioneEventi) {
                div2.scrollTop = div2.scrollHeight;
                primaEsecuzioneEventi = false;
            }
        }
    } catch (err) {
        console.error('Errore durante il caricamento degli eventi:', err);
    }
}

// Prima esecuzione
aggiornaErrori();
aggiornaEventi();

// Ogni 5 secondi (meglio di 1 secondo, più sostenibile)
setInterval(aggiornaErrori, 5000);
setInterval(aggiornaEventi, 5000);