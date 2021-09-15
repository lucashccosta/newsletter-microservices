<?php

define('__BASE_PATH__', dirname(__DIR__));

require_once __DIR__.'/../vendor/autoload.php';

use Dotenv\Dotenv;

$env = Dotenv::createImmutable(__BASE_PATH__);
$env->load();

require_once __DIR__.'/../src/bootstrap/app.php';