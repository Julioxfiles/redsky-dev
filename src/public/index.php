<?php

require_once __DIR__ . '/../vendor/autoload.php';

// Bootstrap
require_once __DIR__ . '/../bootstrap/env.php';
require_once __DIR__ . '/../app/Support/helpers.php';

use App\Http\Request;
use App\Http\Router;
use App\Http\Route;

// Crear request
$request = Request::capture();

// Crear router
$router = new Router();

// Inyectarlo en Route
Route::setRouter($router);

// Cargar rutas
require_once __DIR__ . '/../routes/web.php';
require_once __DIR__ . '/../routes/api.php';

// Ejecutar
$response = $router->dispatch($request);

// Output simple
header('Content-Type: application/json');
echo json_encode($response);