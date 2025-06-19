<?php

    $path = __DIR__ . '/Logs/errors.log';
    // DEBUG: echo $logs;

    // Verifica se il file esiste
    if (file_exists($path)) {
        // Apri il file in modalità lettura ('r')
        $file = fopen($path, 'r');

        // Verifica se l'apertura del file ha avuto successo
        if ($file) {
            // Leggi il file riga per riga
            while (($riga = fgets($file)) !== false) {
                // Stampa la riga
                echo htmlspecialchars($riga) . '<br>'; // htmlspecialchars protegge da XSS
            }

            // Chiudi il file
            fclose($file);
        } else {
            echo 'Errore nell\'apertura del file.';
        }
    } else {
        echo 'Il file non esiste.';
    }

?>