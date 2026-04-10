<?php

require __DIR__ . '/../vendor/autoload.php';

use App\Controllers\DashboardController;
use App\Http\Router;

$router = new Router();

$router->get('/', DashboardController::toRouter());

$router->run();
