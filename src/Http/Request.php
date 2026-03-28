<?php
// src/Support/Request.php

namespace App\Support;

class Request
{
    protected array $get;
    protected array $post;
    protected array $server;
    protected array $headers;

    public function __construct()
    {
        $this->get = $_GET;
        $this->post = $_POST;
        $this->server = $_SERVER;
        $this->headers = $this->parseHeaders();
    }

    // 🔹 Crear instancia (estilo Laravel)
    public static function capture(): self
    {
        return new static();
    }

    // 🔹 Obtener método HTTP
    public function method(): string
    {
        return $this->server['REQUEST_METHOD'] ?? 'GET';
    }

    // 🔹 Obtener URI
    public function uri(): string
    {
        return strtok($this->server['REQUEST_URI'], '?');
    }

    // 🔹 Obtener todos los datos
    public function all(): array
    {
        return array_merge($this->get, $this->post);
    }

    // 🔹 Obtener input específico
    public function input(string $key, $default = null)
    {
        return $this->all()[$key] ?? $default;
    }

    // 🔹 Verificar método
    public function isMethod(string $method): bool
    {
        return strtoupper($method) === $this->method();
    }

    // 🔹 Obtener headers
    protected function parseHeaders(): array
    {
        $headers = [];

        foreach ($this->server as $key => $value) {
            if (str_starts_with($key, 'HTTP_')) {
                $header = str_replace('_', '-', strtolower(substr($key, 5)));
                $headers[$header] = $value;
            }
        }

        return $headers;
    }

    public function header(string $key, $default = null)
    {
        return $this->headers[strtolower($key)] ?? $default;
    }
}