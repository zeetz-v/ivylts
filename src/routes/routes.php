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

Route::get(
    '/users/edit/{uuid}',
    UserController::class,
    'edit'
)
    ->name('users.edit')
    ->whereUuid('uuid');


Route::post(
    '/users/update/{uuid}',
    UserController::class,
    'update'
)
    ->name('users.update');

Route::get(
    '/users/delete/{uuid}',
    UserController::class,
    'delete'
)
    ->name('users.delete')
    ->whereUuid('uuid');