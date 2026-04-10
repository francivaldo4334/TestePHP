<?php

require __DIR__ . '/../vendor/autoload.php';

use App\Controllers\AlunosController;
use App\Controllers\DashboardController;
use App\Controllers\TurmasController;
use App\Http\Router;

$router = new Router();

$router->get('/', DashboardController::toRouter());
$router->registerCrud('/alunos', AlunosController::class);
$router->registerCrud('/turmas', TurmasController::class);

$router->run();
