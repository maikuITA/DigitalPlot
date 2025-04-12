<?php

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

require_once "vendor/autoload.php";

// Impostazioni del database
$isDevMode = true; // Imposta a false in produzione
$conn = [
    'dbname' => 'DigitalPlot',
    'user' => 'root',
    'password' => 'pippo',
    'host' => 'localhost',
    'driver' => 'pdo_mysql',
];

// Configurazione di Doctrine
$config = Setup::createAnnotationMetadataConfiguration([__DIR__ . "/src"], $isDevMode);

// Creazione dell'EntityManager
$entityManager = EntityManager::create($conn, $config);
