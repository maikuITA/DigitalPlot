<?php

namespace Utility;

class LogSys {

    public static function toLog(string $tolog) : void {
        // Nome del file di log
        $logs = __DIR__ . '/events.log';
    
        // Messaggio di log da scrivere
        $timestamp = "[" . date('Y-m-d H:i:s') . "]";
    
        // Apri il file in modalità append (aggiunge il contenuto alla fine del file)
        $file = fopen($logs, 'a');
    
        // Verifica se l'apertura del file ha avuto successo
        if ($file) {
            if($tolog == "") {
                // Se il messaggio da scrivere è vuoto aggiungo SOLO una riga vuota, senza timestamp (PHP_EOL aggiunge una nuova riga)
                fwrite($file, $tolog . PHP_EOL);
            } else {
                // Scrivo la riga nel file, composta da timestamp e messaggio di log
                fwrite($file, $timestamp . " # " . $tolog . PHP_EOL); 
            }
            fclose($file); // Infine chiudo il file di log
        } else {
            echo 'Errore nell\'apertura del file di log. <br>';
            echo 'PERCORSO: ' . $logs . '<br>';
        }
    }

}

?>