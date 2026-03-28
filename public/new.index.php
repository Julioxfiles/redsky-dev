<?php

require_once __DIR__ . '/../vendor/autoload.php';
// Bootstrap
require_once __DIR__ . '/../app/Bootstrap/env.php';
require_once __DIR__ . '/../app/Support/helpers.php';

use App\Http\Request;
use App\Http\Response;
use App\Http\Router;
use App\Http\Route;

// Crear request
$request = Request::capture();

// Crear router
$router = new Router();

// Inyectarlo en Route
Route::setRouter($router);

// Cargar rutas
require_once __DIR__ . '/../app/routes/web.php';
require_once __DIR__ . '/../app/routes/api.php';

// Ejecutar la ruta y obtener respuesta
try {
    $response = $router->dispatch($request);
    /*
    Response::json([
        'status' => 'success',
        'data' => $response,
    ]);
    */
} catch (\Exception $e) {
    /*
    Response::json([
        'status' => 'error',
        'message' => $e->getMessage(),
    ], 500);
    */
}