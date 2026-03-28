<?php

if (!function_exists('env')) {
    function env(string $key, $default = null)
    {
        return $_ENV[$key] ?? getenv($key) ?: $default;
    }
}

if (!function_exists('config')) {
    function config(string $key)
    {
        static $configs = [];

        // Separar: database.connections.mysql
        $parts = explode('.', $key);

        $file = $parts[0];

        // Cargar archivo solo una vez
        if (!isset($configs[$file])) {
            $path = __DIR__ . "/../config/{$file}.php";

            if (!file_exists($path)) {
                throw new Exception("Config file {$file} not found");
            }

            $configs[$file] = require $path;
        }

        // Navegar el array
        $value = $configs[$file];

        foreach (array_slice($parts, 1) as $segment) {
            if (!isset($value[$segment])) {
                return null;
            }
            $value = $value[$segment];
        }

        return $value;
    }
}

function br(int $times = 1) { 
    for ($i = 1; $i <= $times; $i++) {
        echo "<br/>";
    }
}

function title(string $title, string $hn = "h2") { echo "<{$hn}>$title</{$hn}>"; }
