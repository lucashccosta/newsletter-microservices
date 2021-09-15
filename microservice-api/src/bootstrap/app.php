<?php

use Libs\Core\Application;
use App\Container\Injection;

$config = require_once(__DIR__.'/../config/database.php');
$routes = require_once(__DIR__ . '/../app/routes.php');

$app = new Application($config);
Injection::resolve();

foreach ($routes as $key => $route) {
    $key = strtolower($key);
    foreach ($route as $value) {
        list($uri, $controller, $method) = $value;
        $app->router->$key($uri, [$controller, $method]);
    }
}
$app->run();
