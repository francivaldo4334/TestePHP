<?php

namespace App\Http;

class Response {
    private int $status;
    private array $headers;
    private string $contentType;
    private mixed $content;
    
    public function __construct($content, $status = 200, $contentType = 'text/html')
    {
        $this->status = $status;
        $this->content = $content;
        $this->setContentType($contentType);
    }

    public function addHeader($key, $value) {
        $this->headers[$key] = $value;
    }

    public function setContentType($contentType) {
        $this->contentType = $contentType;
        $this->addHeader('Content-Type', $contentType);
    }

    public function sendHeaders(){
        http_response_code($this->status);
        foreach($this->headers as $key=>$value) {
            header($key.': '.$value);
        }
    }

    public function sendResponse(){
        $this->sendHeaders();
        switch ($this->contentType) {
            case 'text/html':
                echo $this->content;
                exit;
            case 'application/pdf':
                echo $this->content;
                exit;
            case 'application/vnd.openxmlformats-officedocument.wordprocessingml.document':
                echo $this->content;
                exit;
            case 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet':
                echo $this->content;
                exit;
        }
    }
}
