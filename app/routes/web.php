<?php

use App\Http\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdapterController;
use App\Http\Controllers\DecoratorController;
use App\Http\Controllers\FacadeController;
use App\Http\Controllers\ProxyController;

Route::get('/users', [UserController::class, 'index']);
Route::post('/users', [UserController::class, 'store']);

// http://localhost/redsky-dev/public/adapter
Route::get('/adapter', [AdapterController::class, 'index']);

// http://localhost/redsky-dev/public/adapter-real
Route::get('/adapter-real', [AdapterController::class, 'realExample']);

// http://localhost/redsky-dev/public/decorator
Route::get('/decorator', [DecoratorController::class, 'index']);

// http://localhost/redsky-dev/public/without-facade
Route::get('/without-facade', [FacadeController::class, 'index']);
// http://localhost/redsky-dev/public/with-facade
Route::get('/with-facade', [FacadeController::class, 'withFacade']);

// http://localhost/redsky-dev/public/proxy
Route::get('/proxy', [ProxyController::class, 'index']);
