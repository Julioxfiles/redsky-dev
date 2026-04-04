<?php

require_once __DIR__ . '/../vendor/autoload.php';
// Bootstrap
require_once __DIR__ . '/../app/bootstrap/env.php';
require_once __DIR__ . '/../app/bootstrap/payments.php';
require_once __DIR__ . '/../app/Support/helpers.php';

use App\Http\Request;
use App\Http\Router;
use App\Http\Route;
use App\Http\Response;

// Crear request
$request = Request::capture();

// Crear router
$router = new Router();

// Inyectarlo en Route
Route::setRouter($router);

// Cargar rutas
require_once __DIR__ . '/../app/routes/web.php';
require_once __DIR__ . '/../app/routes/api.php';

// Ejecutar
//$response = $router->dispatch($request);

// Output limpio
//Response::json($response);
// Ejecutar la ruta y obtener respuesta

/*
try {
    $response = $router->dispatch($request);
    /*
    Response::json([
        'status' => 'success',
        'data' => $response,
    ]);
    */
//} catch (\Exception $e) {
    /*
    Response::json([
        'status' => 'error',
        'message' => $e->getMessage(),
    ], 500);
    */
//}

try {
    $response = $router->dispatch($request);
    echo $response; // THIS will show echoes from middleware too
} catch (\Exception $e) {
    echo $e->getMessage(); // show exception message
}