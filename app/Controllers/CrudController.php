<?php

namespace App\Controllers;

use App\Http\Request;
use App\Http\Response;
use Exception;

abstract class CrudController extends Controller {
    abstract function get(Request $request): Response;
    abstract function post(Request $request): Response;
    abstract function delete(Request $request): Response;

    public function entry(Request $request): Response
    {
    	switch($request->getMethod()){
    	    case 'GET':
    	        return $this->get($request);
            case 'DELETE':
                return $this->delete($request);
            case 'POST':
                return $this->post($request);
    	    default:
    	        throw new Exception('Metodo invalido.', 400);
    	}
    }
}
