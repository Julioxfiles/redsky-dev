<?php
// src/Support/Request.php

namespace App\Http;

class Request
{
    protected array $get;
    protected array $post;
    protected array $server;
    protected array $headers;
    protected array $json = [];

    public function __construct()
    {
        $this->get = $_GET;
        $this->post = $_POST;
        $this->server = $_SERVER;
        $this->headers = $this->parseHeaders();

        // Nuevo: parsear JSON sin romper nada
        $raw = file_get_contents('php://input');
        $decoded = json_decode($raw, true);

        if (is_array($decoded)) {
            $this->json = $decoded;
        }
    }

    // Crear instancia (estilo Laravel)
    public static function capture(): self
    {
        return new static();
    }

    // Obtener método HTTP
    public function method(): string
    {
        return $this->server['REQUEST_METHOD'] ?? 'GET';
    }

    // Obtener URI
    public function uri(): string
    {
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

        // Remove base path
        $basePath = '/redsky-dev/public';

        if (str_starts_with($uri, $basePath)) {
            $uri = substr($uri, strlen($basePath));
        }

        // Default
        if ($uri === '') {
            $uri = '/';
        }

        // Remove trailing slash
        if ($uri !== '/') {
            $uri = rtrim($uri, '/');
        }

        return $uri;
    }

    // Obtener todos los datos
    public function all(): array
    {
        return array_merge($this->get, $this->post, $this->json);
    }

    // Obtener input específico
    public function input(string $key, $default = null)
    {
        return $this->all()[$key] ?? $default;
    }

    // Verificar método
    public function isMethod(string $method): bool
    {
        return strtoupper($method) === $this->method();
    }

    // Obtener headers
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