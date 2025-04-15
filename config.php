<?php

use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\ORMSetup;
use Doctrine\ORM\EntityManager;

require_once "vendor/autoload.php";

// Impostazioni del database
$conn = [
    'dbname' => 'DigitalPlot',
    'user' => 'root',
    'password' => 'pippo',
    'host' => 'localhost',
    'driver' => 'pdo_mysql',
];

// Configurazione di Doctrine
$config = ORMSetup::createAttributeMetadataConfiguration(paths: [__DIR__ . "/Progetto/Entity/"], isDevMode: true);

$connessione = DriverManager::getConnection($conn, $config);

// Creazione dell'EntityManager
$entityManager = new EntityManager($connessione, $config);
