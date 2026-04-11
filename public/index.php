<?php

require __DIR__ . '/../vendor/autoload.php';

use App\Controllers\AlunosController;
use App\Controllers\DashboardController;
use App\Controllers\NotasController;
use App\Controllers\TurmasController;
use App\Http\Router;

$router = new Router();

$router->get('/', DashboardController::toRouter());
$router->registerCrud('/alunos', AlunosController::class);
$router->registerCrud('/turmas', TurmasController::class);
$router->registerCrud('/notas', NotasController::class);

$router->get('/reports/pdf', DashboardController::toRouter('generateReportPdf'));
$router->get('/reports/docx', DashboardController::toRouter('generateReportDocx'));

$router->run();
