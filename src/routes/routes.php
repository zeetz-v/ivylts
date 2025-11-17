<?php

namespace src\routes;

use src\app\controllers\HelloController;
use src\app\controllers\UsuarioController;
use src\core\Route;


Route::get(
    '/hello',
    HelloController::class,
    'hello'
)
    ->name('hello');
