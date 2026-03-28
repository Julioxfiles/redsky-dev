<?php

if (!function_exists('env')) {
    function env(string $key, $default = null)
    {
        static $loaded = false;
        static $values = [];

        if (!$loaded) {
            $envFile = __DIR__ . '/../.env'; // relative to app/Support/
            if (file_exists($envFile)) {
                foreach (file($envFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) as $line) {
                    if (strpos(trim($line), '#') === 0) continue;
                    if (!strpos($line, '=')) continue;
                    [$name, $value] = explode('=', $line, 2);
                    $values[trim($name)] = trim($value);
                }
            }
            $loaded = true;
        }

        return $values[$key] ?? $_ENV[$key] ?? getenv($key) ?: $default;
    }
}

if (!function_exists('config')) {
    function config(string $key)
    {
        static $configs = [];

        $parts = explode('.', $key);
        $file = $parts[0];

        if (!isset($configs[$file])) {
            $path = __DIR__ . "/../Config/{$file}.php"; // <-- fixed path

            if (!file_exists($path)) {
                throw new Exception("Config file {$file} not found at {$path}");
            }

            $configs[$file] = require $path;
        }

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

function title(string $title, string $hn = "h2") { 
    echo "<{$hn}>$title</{$hn}>"; 
}