<?php

require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/../bootstrap/env.php';
require_once __DIR__ . '/../Support/helpers.php';

use App\Controllers\UserController;
use App\Services\UserService;
use App\Repositories\UserRepository;
use App\Support\Validator;
use App\Support\Mailer;
use App\Database\Connection;

// Crear dependencias
$db = Connection::make();

$userRepository = new UserRepository($db);
$validator = new Validator();
$mailer = new Mailer();

$userService = new UserService($userRepository, $validator, $mailer);

$controller = new UserController($userService);

// Simulación de request
$response = $controller->register([
    'email' => 'test@test.com',
    'password' => '123456'
]);

print_r($response);