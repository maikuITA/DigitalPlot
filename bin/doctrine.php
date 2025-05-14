<?php
// script to build the database
// and create the tables
use Doctrine\ORM\Tools\Console\ConsoleRunner;
use Doctrine\ORM\Tools\Console\EntityManagerProvider\SingleManagerProvider;

require_once (__DIR__ . '/../Progetto/Utility/bootstrapDoctrine.php');

$entityManager = getEntityManager();

ConsoleRunner::run(
    new SingleManagerProvider($entityManager)
);

// php bin/doctrine.php orm:schema-tool:create