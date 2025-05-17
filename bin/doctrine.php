<?php
// script to build the database
// and create the tables
use Doctrine\ORM\Tools\Console\ConsoleRunner;
use Doctrine\ORM\Tools\Console\EntityManagerProvider\SingleManagerProvider;

require_once (__DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "Progetto" . DIRECTORY_SEPARATOR . "Utility" . DIRECTORY_SEPARATOR . "bootstrapDoctrine.php");

$entityManager = getEntityManager();

ConsoleRunner::run(
    new SingleManagerProvider($entityManager)
);

// php bin/doctrine.php orm:schema-tool:create