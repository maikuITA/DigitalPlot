<?php

    $path = __DIR__ . '/Logs/events.log';
    // DEBUG: echo $logs;

    if (file_exists($path)) {
        /**
         * file_get_contents reads the entire file into a string. Gli accapo diventano \n
         * and then nl2br converts them to <br> tags for HTML display.
         */
        echo nl2br(file_get_contents($path));
    } else {
        echo "File di log non trovato: $path";
    }

