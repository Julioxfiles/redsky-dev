<?php

namespace App\Patterns\Singleton;
use PDO;

class Database
{
    private static ?Database $instance = null;
    private \PDO $connection;

    private function __construct()
    {
        $host = '127.0.0.1';
        $db   = 'redskydev';
        $user = 'root';
        $pass = '';
        $charset = 'utf8mb4';

        $dsn = "mysql:host=$host;dbname=$db;charset=$charset";

        $this->connection = new PDO($dsn, $user, $pass, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]);
    }

    public static function getInstance(): Database
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function getConnection(): PDO
    {
        return $this->connection;
    }
}