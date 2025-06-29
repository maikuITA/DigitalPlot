<?php

$path = __DIR__ . '/Logs/errors.log';
$righeDaMostrare = 50; // Cambia questo numero a piacere

// Reads the last 'lines' lines from a file 
function tail($filepath, $lines = 50)
{
    $f = fopen($filepath, "rb"); // Open the file in binary mode
    if (!$f) return false; // check if the file was opened successfully, if not return false

    $buffer = '';  // Initialize an empty buffer to store the lines
    $chunkSize = 4096; // Define the size of the chunks to read from the file
    fseek($f, 0, SEEK_END); // Move the file pointer to the end of the file (0 represents the offset, SEEK_END means to start from the end)
    $pos = ftell($f); // save the current position of the file pointer (at the end of the file)
    $lineCount = 0; // Initialize the line count to zero

    while ($pos > 0 && $lineCount <= $lines) {
        $readSize = ($pos >= $chunkSize) ? $chunkSize : $pos; // Determine how much to read, either the full chunk size or the remaining bytes
        $pos -= $readSize; // Move the position back by the read size
        fseek($f, $pos); // Move the file pointer to the new position
        $chunk = fread($f, $readSize); // Read the chunk of data from the file
        $buffer = $chunk . $buffer; // Prepend the chunk to the buffer
        $lineCount = substr_count($buffer, "\n"); // Count the number of new lines in the buffer
    }

    fclose($f); // Close the file after reading
    $linesArray = explode("\n", $buffer); // Split the buffer into an array of lines
    return implode("\n", array_reverse(array_slice($linesArray, -$lines)));
    // Use array_slice to get the last 'lines' lines from the array because it can read more than 'righe da mostrare' (binay mode)
    // Return the last 'lines' lines in reverse (array_reverse) order, each line separated from the next by /n

}

header('Content-Type: text/html; charset=UTF-8');
if (file_exists($path)) {
    echo nl2br(tail($path, $righeDaMostrare));
} else {
    echo "It does not exist.";
}
