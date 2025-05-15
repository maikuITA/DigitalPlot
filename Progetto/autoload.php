<?php

spl_autoload_register(function ($class_name) {

    // Definizione dei percorsi dei package
    $directories = [
        __DIR__ . DIRECTORY_SEPARATOR . "Entity",
        __DIR__ . DIRECTORY_SEPARATOR . "Foundation",
        __DIR__ . DIRECTORY_SEPARATOR . "Controller",
        __DIR__ . DIRECTORY_SEPARATOR . "Utility",
        __DIR__ . DIRECTORY_SEPARATOR . "View"
    ];

    // Cerca la classe in ciascun package
    foreach ($directories as $directory) {
        $file = $directory . DIRECTORY_SEPARATOR . $class_name . ".php";
        if (file_exists($file)) {
            include $file;
            return;
        }
    }

    // Messaggio di errore se il file non viene trovato
    echo "Error: file not found for class $class_name";
});