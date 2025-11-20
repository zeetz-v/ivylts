<?php

namespace src\routes;

use src\app\controllers\UserController;
use src\core\Route;


Route::get(
    '/users/list',
    UserController::class,
    'list'
)
    ->name('users.list');

Route::post(
    '/users/store',
    UserController::class,
    'store'
)
    ->name('users.store');
