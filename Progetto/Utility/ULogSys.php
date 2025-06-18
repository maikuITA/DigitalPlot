<?php

// File by which you can update log files

class ULogSys {

    /**
     *  Writes a log message to the log file.
     *  If the message is empty, it writes only a new line without a timestamp.
     *   @param string $tolog The message to log.
     *   @return void
     */
    public static function toLog(string $tolog, bool $error = false) : void {

        if ($error) {
            // scrivi il messaggio di errore nel file di error log
            // prende il path del file di log
            $logs = __DIR__ . DIRECTORY_SEPARATOR .'Logs' . DIRECTORY_SEPARATOR . 'errors.log';
        }
        else {
            // prende il path del file di log
           $logs = __DIR__ . DIRECTORY_SEPARATOR .'Logs' . DIRECTORY_SEPARATOR . 'events.log';
        }

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