<?php

namespace src\routes;

use src\app\controllers\HelloController;
use src\core\Route;


Route::get(
    '/hello',
    HelloController::class,
    'hello'
)
    ->name('hello');

Route::post(
    '/users/store',
    HelloController::class,
    'store'
)
    ->name('store');
