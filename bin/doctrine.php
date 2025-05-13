<?php

use Doctrine\ORM\Tools\Console\ConsoleRunner;
use Doctrine\ORM\Tools\Console\EntityManagerProvider\SingleManagerProvider;

require_once __DIR__ . '/../config.php';

ConsoleRunner::run(
    new SingleManagerProvider($entityManager)
);

// php bin/doctrine.php orm:schema-tool:create