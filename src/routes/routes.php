<?php

namespace src\routes;

use src\app\controllers\CheckinController;
use src\core\Route;


Route::get('/read', CheckinController::class, 'read')
    ->name('read');

Route::post('/checkin', CheckinController::class, 'checkin')
    ->name('checkin');

    Route::get('/details', CheckinController::class, 'details')
    ->name('details');