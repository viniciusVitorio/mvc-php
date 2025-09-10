<?php
use src\Facades\Route;
use src\Controllers\PersonController;
use src\Controllers\ContactController;

Route::get('/',                 [PersonController::class, 'index']);
Route::get('/people',           [PersonController::class, 'index']);
Route::get('/people/create',    [PersonController::class, 'create']);
Route::post('/people/store',    [PersonController::class, 'store']);
Route::get('/people/edit',      [PersonController::class, 'edit']);
Route::post('/people/update',   [PersonController::class, 'update']);
Route::post('/people/delete',   [PersonController::class, 'destroy']);

Route::get('/contacts',           [ContactController::class, 'index']);
Route::get('/contacts/create',    [ContactController::class, 'create']);
Route::post('/contacts/store',    [ContactController::class, 'store']);
Route::get('/contacts/edit',      [ContactController::class, 'edit']);
Route::post('/contacts/update',   [ContactController::class, 'update']);
Route::post('/contacts/delete',   [ContactController::class, 'destroy']);
