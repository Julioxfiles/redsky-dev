<?php

$envFile = __DIR__ . '/../../.env';

if (!file_exists($envFile)) {
    throw new Exception('.env file not found');
}

$lines = file($envFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

foreach ($lines as $line) {
    $line = trim($line);

    // Ignorar comentarios
    if ($line === '' || str_starts_with($line, '#')) {
        continue;
    }

    // Separar clave y valor
    [$key, $value] = explode('=', $line, 2);

    $key = trim($key);
    $value = trim($value);

    // Quitar comillas si existen
    $value = trim($value, "\"'");

    // Guardar en variables de entorno
    $_ENV[$key] = $value;
    putenv("$key=$value");
}