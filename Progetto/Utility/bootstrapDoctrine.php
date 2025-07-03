<?php

require_once(__DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "vendor" . DIRECTORY_SEPARATOR . "autoload.php");
require_once(__DIR__ . DIRECTORY_SEPARATOR . "config.php");

use Doctrine\ORM\EntityManager;
use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\ORMSetup;

// This function initializes and returns an EntityManager instance.
// The EntityManager is responsible for managing the persistence of entities in the database.
function getEntityManager(): EntityManager
{
    $entityManager = null;
    if ($entityManager === null) {

        // Connection parameters for the database, in this case the Altervista's db
        $conn = [
            'dbname' => DB_NAME,
            'user' => DB_USER,
            'password' => DB_PASS,
            'host' => DB_HOST,
            'driver' => DRIVER
        ];
        // Creation of the configuration for the Doctrine ORM
        // The paths parameter specifies where the entity classes and the attributes PHP 8 (e.g. [ORM\Entity]) are located
        // The isDevMode parameter indicates whether the application is in development mode or not
        $config = ORMSetup::createAttributeMetadataConfiguration(paths: [__DIR__ . "/../Entity/"], isDevMode: true);

        // the connection to the database is established using the DriverManager class
        // which takes the connection parameters and configuration as arguments
        $connessione = DriverManager::getConnection($conn, $config);

        // finally, the EntityManager is created using the connection and configuration
        // The EntityManager is the main class for interacting with the database
        $entityManager =  new EntityManager($connessione, $config);
    }
    return $entityManager;
}
