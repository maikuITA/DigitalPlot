<?php

// File by which you can update log files

class ULogSys
{

    /**
     *  Writes a log message to the log file.
     *  If the message is empty, it writes only a new line without a timestamp.
     *   @param string $message The message to log.
     *   @return void
     */
    public static function toLog(string $message, bool $error = false): void
    {

        // determines if the log is an error or an event

        if ($error) {
            $logs = __DIR__ . DIRECTORY_SEPARATOR . 'Logs' . DIRECTORY_SEPARATOR . 'errors.log';
        } else {
            $logs = __DIR__ . DIRECTORY_SEPARATOR . 'Logs' . DIRECTORY_SEPARATOR . 'events.log';
        }

        // writes the current timestamp in the format [YYYY-MM-DD HH:MM:SS]
        $timestamp = "[" . date('Y-m-d H:i:s') . "]";

        // opens the log file in append mode ('a'), which allows writing to the end of the file without truncating it
        $file = fopen($logs, 'a');

        // verifies if the file was opened successfully
        if ($file) {
            if ($message == "") {
                // if there is nothing to write, it writes only a new line(by PHP EOL) without a timestamp
                fwrite($file, $message . PHP_EOL . "\n");
            } else {
                // otherwise, it writes the timestamp followed by the log message
                fwrite($file, $timestamp . " # " . $message . PHP_EOL . "\n");
            }
            fclose($file); // closes the file after writing
        } else {
            echo 'Errore nell\'apertura del file di log. <br>';
            echo 'PERCORSO: ' . $message . '<br>';
        }
    }
}
