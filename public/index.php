<?php

require __DIR__ . '/../vendor/autoload.php';

use App\Http\Router;
use App\Views\View;

$router = new Router();

$router->get('/', function(){
    return View::render('base', [
        'name'=>"Nome"
    ]);
});

$router->run();
