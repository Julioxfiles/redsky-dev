<?php

namespace App\Http;

class JsonResponse
{
    protected mixed $data;
    protected int $status;
    protected array $headers;

    public function __construct(mixed $data = null, int $status = 200, array $headers = [])
    {
        $this->data = $data;
        $this->status = $status;
        $this->headers = $headers;
    }

    public function send(): void
    {
        http_response_code($this->status);

        header('Content-Type: application/json');

        foreach ($this->headers as $key => $value) {
            header("$key: $value");
        }

        echo json_encode($this->data, JSON_UNESCAPED_UNICODE);
        exit;
    }

    public static function make(mixed $data = null, int $status = 200, array $headers = []): self
    {
        return new self($data, $status, $headers);
    }
}