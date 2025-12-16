<?php

namespace src\routes;

use src\app\controllers\SkopeController;
use src\core\Route;


Route::get(
    '/',
    SkopeController::class,
    'index'
)
    ->name('skopes.index');
