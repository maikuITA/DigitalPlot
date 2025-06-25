console.log("log loaded");

let primaEsecuzioneErrori = true;
let primaEsecuzioneEventi = true;

function aggiornaErrori() {
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            const div1 = document.getElementById("contenuto-file-errori");
            if (div1) {
                div1.innerHTML = xhr.responseText;

                // Scorri in fondo solo alla prima esecuzione
                if (primaEsecuzioneErrori) {
                    div1.scrollTop = div1.scrollHeight;
                    primaEsecuzioneErrori = false;
                }
            }
        }
    };
    xhr.open('GET', '/Progetto/Utility/ULeggiErrori.php?t=' + new Date().getTime(), true); // previene cache
    xhr.send();
}

function aggiornaEventi() {
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            const div2 = document.getElementById("contenuto-file-eventi");
            if (div2) {
                div2.innerHTML = xhr.responseText;

                // Scorri in fondo solo alla prima esecuzione
                if (primaEsecuzioneEventi) {
                    div2.scrollTop = div2.scrollHeight;
                    primaEsecuzioneEventi = false;
                }
            }
        }
    };
    xhr.open('GET', '/Progetto/Utility/ULeggiEventi.php?t=' + new Date().getTime(), true); // previene cache
    xhr.send();
}

// Esecuzione iniziale immediata
aggiornaErrori();
aggiornaEventi();

// Aggiorna ogni minuto
setInterval(aggiornaErrori, 60 * 1000);
setInterval(aggiornaEventi, 60 * 1000);
