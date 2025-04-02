<?php

require_once 'Progetto/autoload.php';
require_once 'StartSmarty.php';

use Controller\CRunner;

// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

// Avvio il runner (FrontController)
$runner = new CRunner();
$runner->run();

?>