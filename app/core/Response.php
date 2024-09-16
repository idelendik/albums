<?php

declare(strict_types=1);

namespace Albums\core;

class Response
{
    private array $headers = ['Content-Type: application/json'];

    public function __construct(
        private bool  $success,
        private int   $statusCode = 0,
        private mixed $body = [],
        private array $errors = []
    )
    {
    }

    public function send(): void
    {
        http_response_code($this->statusCode);

        foreach ($this->headers as $header) {
            header($header);
        }

        echo json_encode([
            'success' => $this->success,
            'data' => $this->body,
            'errors' => $this->errors
        ]);

        exit();
    }
}