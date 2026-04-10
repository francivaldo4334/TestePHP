<?php

namespace App\Http;

use Closure;
use Exception;

class Router {
    private array $routers = [];

    public function addRouter($method, $uri, $closure) {
        if (!($closure instanceof Closure)) {
            throw new Exception('Error closure da rota '.$method.' '.$uri.' invalida.',500);
        }
        $this->routers[$uri][$method] = $closure;
    }

    public function get($uri, $closure) {
        $this->addRouter('GET', $uri, $closure);
    }

    private function getRouter(){
        try {
            $request = new Request();
            $method = $request->getMethod();
            $uri = $request->getUri();

            if (isset($this->routers[$uri][$method])) {
                $response = $this->routers[$uri][$method]();
                if ($response instanceof Response) {
                    return $response;
                }
                throw new Exception('O retorno de '.$method.' '.$uri.' deve ser uma instância de Response.', 500);
            }
            throw new Exception('Página não encontrada.', 404);

        } catch (Exception $e) {
            return new Response($e->getMessage(), $e->getCode());
        }
    }

    public function run(): void {
        $response = $this->getRouter();
        $response->sendResponse();
    }
}
