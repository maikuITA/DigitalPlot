<?php

require_once 'Progetto/autoload.php';
require_once 'vendor/autoload.php';
require_once 'Progetto/Utility/config.php';

// Avvio il runner (FrontController)
$runner = new CFrontController();
$runner->start();
