<?php

require_once 'Progetto/autoload.php';
require_once 'vendor/autoload.php';
require_once 'Progetto/Utility/config.php';

// Provo ad istallare il database
//InstallerDb::install();

// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

// Avvio il runner (FrontController)
$runner = new CFrontController();
$runner->start();

?>