<?php

namespace App\Controllers;

use App\Http\Request;
use App\Http\Response;

abstract class Controller {
    abstract function entry(Request $request): Response;

    final static function toRouter(?string $method = 'entry'){
        return function($request) use ($method){
            $controllerInstance = new static();
            if (method_exists($controllerInstance, $method)) {
                return $controllerInstance->$method($request); 
            }
            throw new \Exception("Método {$method} não encontrado no controller.", 404);
        };
    }
}
