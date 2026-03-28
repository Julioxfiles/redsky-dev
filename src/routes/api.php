<?php

use App\Http\Route;

Route::get('/api/status', function () {
    return ['status' => 'ok'];
});