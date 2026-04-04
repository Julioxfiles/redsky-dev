<?php

use App\Http\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdapterController;
use App\Http\Controllers\DecoratorController;
use App\Http\Controllers\FacadeController;
use App\Http\Controllers\ProxyController;
use App\Http\Controllers\StrategyController;
use App\Http\Controllers\SimpleFactoryController;
use App\Http\Controllers\FactoryMethodController;
use App\Http\Controllers\AbstractFactoryController;
use App\Http\Controllers\CompositeController;
use App\Http\Controllers\BuilderController;
use App\Http\Controllers\ObserverController;
use App\Http\Controllers\ChainController;

Route::get('/home', [HomeController::class, 'index']);

Route::get('/users', [UserController::class, 'index']);
Route::post('/users', [UserController::class, 'store']);

// http://localhost/redsky-dev/public/adapter
Route::get('/adapter1', [AdapterController::class, 'index']);
// http://localhost/redsky-dev/public/adapter-real
Route::get('/adapter2', [AdapterController::class, 'index2']);

// http://localhost/redsky-dev/public/decorator
Route::get('/decorator', [DecoratorController::class, 'index']);

// http://localhost/redsky-dev/public/without-facade  Without Facade
Route::get('/facade1', [FacadeController::class, 'index']);

// http://localhost/redsky-dev/public/with-facade With Facade
Route::get('/facade2', [FacadeController::class, 'index2']);

// http://localhost/redsky-dev/public/proxy
Route::get('/proxy1', [ProxyController::class, 'index']);

// http://localhost/redsky-dev/public/proxy
Route::get('/proxy2', [ProxyController::class, 'index2']);

/*  
  {
    "method": "paypal",
    "amount": 100
  }
 */
Route::post('/strategy', [StrategyController::class, 'payAction']);

/*  
  {
    "method": "paypal",
    "amount": 100
  }
 */
Route::post('/simple-factory', [SimpleFactoryController::class, 'payAction']);

/*  
  {
    "data": "This is the data of the report to be exported.",
    "exportTo": "Excel"
  }
 */
Route::post('/factory-method', [FactoryMethodController::class, 'index']);

Route::get('/abstrac-factory1', [AbstractFactoryController::class, 'lightTheme']);
Route::get('/abstrac-factory2', [AbstractFactoryController::class, 'darkTheme']);

// http://localhost/redsky-dev/public/builder
Route::get('/builder', [BuilderController::class, 'index']);

// http://localhost/redsky-dev/public/composite
Route::get('/composite', [CompositeController::class, 'index']);

// http://localhost/redsky-dev/public/observer
Route::post('/observer', [ObserverController::class, 'save']);

Route::post('/chain', [ChainController::class, 'index'])
    ->middleware(['auth.custom', 'log']);

