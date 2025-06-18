<?php

require_once (__DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "vendor" . DIRECTORY_SEPARATOR . "autoload.php");
require_once (__DIR__ . DIRECTORY_SEPARATOR . "config.php");

use Doctrine\ORM\EntityManager;
use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\ORMSetup;


function getEntityManager(): EntityManager{
    $entityManager = null;
    if ($entityManager === null) {
        // Impostazioni del database
        $conn = [
            'dbname' => DB_NAME,
            'user' => DB_USER,
            'password' => DB_PASS,
            'host' => DB_HOST,
            'driver' => DRIVER
        ];
        // Configurazione di Doctrine
        $config = ORMSetup::createAttributeMetadataConfiguration(paths: [__DIR__ . "/../Entity/"], isDevMode: true);

        $connessione = DriverManager::getConnection($conn, $config);

        // Creazione dell'EntityManager rappresentativo delle classi di foundation
        $entityManager =  new EntityManager($connessione, $config);
    }
    return $entityManager;
    
}


?>