<?php

namespace App\Http;

class Request {
    private string $uri;
    private string $method;
    private array $body;
    private array $params;
    private array $headers;

    public function __construct()
    {
        $this->params = $_GET ?? [];
        $this->body = $_POST ?? [];
        $this->headers = getallheaders();
        $this->method = $_SERVER['REQUEST_METHOD'] ?? '';
        $this->uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) ?? '';
    }

    public function getMethod():string {
        return $this->method;
    }
    public function getUri():string {
        return $this->uri;
    }
    public function getBody(){
        return $this->body;
    }

}
