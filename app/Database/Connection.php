<?php

namespace App\Database;

use PDO;
use Exception;
use PDOException;


class Connection
{
    private static ?PDO $instance = null;

    public static function make(): PDO
    {
        if (self::$instance instanceof PDO) {
            return self::$instance;
        }

        try {
            // Get DB config from config file
            $config = config('database.connections.mysql');

            $driver   = $config['driver'] ?? 'mysql';
            $host     = $config['host'] ?? '127.0.0.1';
            $port     = $config['port'] ?? '3306';
            $database = $config['database'] ?? 'redskydev';
            $username = $config['username'] ?? 'root';
            $password = $config['password'] ?? '';
            
            //echo "<pre>"; print_r($config); die;

            if ($driver === 'mysql') {
                $dsn = "mysql:host={$host};port={$port};dbname={$database};charset={$config['charset']}";
            } else {
                throw new Exception("Unsupported DB driver: {$driver}");
            }

            $dsn = "mysql:host={$host};port={$port};dbname={$database};charset={$config['charset']}";
            //var_dump($dsn); // <-- add this temporarily
            //die();

            self::$instance = new PDO($dsn, $username, $password, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            ]);

            return self::$instance;

        } catch (Exception $e) {
            throw new Exception("Database connection failed: " . $e->getMessage());
        }
    }
}