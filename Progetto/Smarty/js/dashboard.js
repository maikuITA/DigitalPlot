async function upgradeDashboard() {
  try {
    const response = await fetch('/dashboardUpdate'); // waits the response from the server
    if (!response.ok) {
      throw new Error(`Errore HTTP: ${response.status}`);
    }

    const data = await response.json(); // waits for the data and converts it to JSON
    console.log('Dati ricevuti:', data);

    // It takes the objects and updates their content
    document.getElementById("last24A").textContent = data.lastGA; // takes the content of the object with id "last24A" and updates it with the value of data.lastGA
    document.getElementById("lastSA").textContent = data.lastSA;
    document.getElementById("lastMA").textContent = data.lastMA;
    document.getElementById("totalA").textContent = data.totalA;
    document.getElementById("last24P").textContent = data.lastGP;
    document.getElementById("lastSP").textContent = data.lastSP;
    document.getElementById("lastMP").textContent = data.lastMP;
    document.getElementById("totalP").textContent = data.totalP;
    document.getElementById("totalU").textContent = data.totalU;
    document.getElementById("abbAttivi").textContent = data.abbAttivi;

  } catch (error) {
    console.error('Errore durante la richiesta:', error);
  }
}

// Esegui la funzione al caricamento della pagina   
window.addEventListener('load', () => {
  upgradeDashboard();

  // Imposta l'intervallo per eseguirla ogni 30 minuti (30 * 60 * 1000 ms)
  setInterval(upgradeDashboard, 30 * 60 * 1000);
});