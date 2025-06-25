<?php
//Database connection settings
define('DB_HOST', 'localhost');
define('DB_USER', 'digitalplot');
define('DB_PASS', '');
define('DB_NAME', 'my_digitalplot');
define('DRIVER', 'pdo_mysql');

//session cookie expiration
define('COOKIE_EXP_TIME', 2592000); // 30 days in seconds

//points per Reading
define('POINTS', 10);
define('POINTS_MULTIPLIER', 0.01);

// users
define('BASIC', 0);
define('READER', 1);
define('WRITER', 2);
define('ADMIN', 3);

// areticles status
define('APPROVED', 'approvato');
define('PENDING', 'in attesa');
define('REFUSED', 'rifiutato');