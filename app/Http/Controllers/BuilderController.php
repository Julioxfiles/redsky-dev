<?php

namespace App\Http\Controllers;
use App\Database\QueryBuilder;

// This could be called QueryController.
class BuilderController {
    public function index() {
        $qb = new QueryBuilder();

        $sql = $qb
            ->table('users')
            ->select(['id', 'name', 'email'])
            ->where('age', '>', 18)
            ->where('status', '=', 'active')
            ->orderBy('name', 'ASC')
            ->build();

        echo $sql;
    }
}