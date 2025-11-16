<?php

namespace src\routes;


use src\app\controllers\UsuarioController;
use src\core\Route;

//Quando tiver {id} -> whereInt(['id'])

Route::get('/dispositivos/usuarios', UsuarioController::class, 'cadastroUsuarioView')
    ->name('parametrizacao.usuario');

Route::post('/dispositivos/usuarios/store', UsuarioController::class, 'storeUsuario')
    ->name('parametrizacao.usuario.store');

Route::post('/dispositivos/usuarios/update', UsuarioController::class, 'updateUsuario')
    ->name('parametrizacao.usuario.update');

Route::get('/dispositivos/usuarios/consulta', UsuarioController::class, 'consultaUsuario')
    ->name('parametrizacao.usuario.consulta');

Route::get('/dispositivos/usuarios/modalConfirm/{id}', UsuarioController::class, 'modalConfirm')
    ->name('parametrizacao.modal.delete')
    ->whereUuid(['id']);

Route::get('/dispositivos/usuarios/modalEdit/{id}', UsuarioController::class, 'modalEdit')
    ->name('parametrizacao.modal.edit')
    ->whereUuid(['id']);

 Route::get('/dispositivos/usuarios/delete/{id}', UsuarioController::class, 'deleteUsuario')
    ->name('parametrizacao.usuario.delete')
    ->whereUuid(['id']);




