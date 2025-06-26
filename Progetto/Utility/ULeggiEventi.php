<?php

    $path = __DIR__ . '/Logs/events.log';
    $righeDaMostrare = 50; // Cambia questo numero a piacere

    function tail($filepath, $lines = 50) {
        $f = fopen($filepath, "rb");
        if (!$f) return false;

        $buffer = '';
        $chunkSize = 4096;
        fseek($f, 0, SEEK_END);
        $pos = ftell($f);
        $lineCount = 0;

        while ($pos > 0 && $lineCount <= $lines) {
            $readSize = ($pos >= $chunkSize) ? $chunkSize : $pos;
            $pos -= $readSize;
            fseek($f, $pos);
            $chunk = fread($f, $readSize);
            $buffer = $chunk . $buffer;
            $lineCount = substr_count($buffer, "\n");
        }

        fclose($f);
        $linesArray = explode("\n", $buffer);
        return implode("\n", array_reverse(array_slice($linesArray, $lines)));
    }

    header('Content-Type: text/html; charset=UTF-8');
    if (file_exists($path)) {
        echo nl2br(tail($path, $righeDaMostrare));
    } else {
        echo "Il file di log non esiste.";
    }
?>