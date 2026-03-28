<?php

namespace App\Database;

use PDO;
use PDOException;

class Connection
{
    public static function make(): PDO
    {
        $config = config('database');

        $default = $config['default'];
        $connection = $config['connections'][$default];

        $driver = $connection['driver'];
        $host = $connection['host'];
        $port = $connection['port'];
        $database = $connection['database'];
        $username = $connection['username'];
        $password = $connection['password'];
        $charset = $connection['charset'];

        $dsn = "{$driver}:host={$host};port={$port};dbname={$database};charset={$charset}";

        try {
            return new PDO($dsn, $username, $password, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            ]);
        } catch (PDOException $e) {
            throw new PDOException(
                "Database connection failed: " . $e->getMessage()
            );
        }
    }
}