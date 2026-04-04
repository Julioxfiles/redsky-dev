<?php

namespace App\Http\Controllers;
use App\Patterns\Singleton\Database;

class SingletonController {

    public function index() {
        $db1 = Database::getInstance()->getConnection();
        $db2 = Database::getInstance()->getConnection();

        var_dump($db1 === $db2); // true
    }
}