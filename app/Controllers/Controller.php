<?php

namespace App\Controllers;

use App\Http\Request;
use App\Http\Response;

abstract class Controller {
    abstract function entry(Request $request): Response;

    final static function toRouter(){
        return function($request){
          $controllerInstance = new static();
          return $controllerInstance->entry($request); 
        };
    }
}
