
function aggiornaErrori() {
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            document.getElementById('contenuto-file-errori').innerHTML = xhr.responseText;
        }
    };
    xhr.open('GET', '/Progetto/Utility/ULeggiErrori.php', true);
    xhr.send();
    const div1 = document.getElementById("contenuto-file-errori");
    div1.scrollTop = div1.scrollHeight;
}
setInterval(aggiornaErrori, 1000); // Aggiorna ogni secondo

function aggiornaEventi() {
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            document.getElementById('contenuto-file-eventi').innerHTML = xhr.responseText;
        }
    };
    xhr.open('GET', '/Progetto/Utility/ULeggiEventi.php', true);
    xhr.send();
    const div2 = document.getElementById("contenuto-file-eventi");
    div2.scrollTop = div2.scrollHeight;
}
setInterval(aggiornaEventi, 1000); // Aggiorna ogni secondo