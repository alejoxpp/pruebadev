<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContribuyenteController;
use App\Http\Controllers\AuthController;


Route::get('/', [ContribuyenteController::class, 'index'])
    ->middleware('auth');
// Acciones para superusuarios: crear y eliminar contribuyentes
Route::resource('contribuyentes', ContribuyenteController::class)
    ->only(['create', 'store', 'destroy'])
    ->middleware(['auth', 'superusuario']);
// Ver detalles para administradores y superusuarios
Route::resource('contribuyentes', ContribuyenteController::class)
    ->only(['show', 'edit', 'update'])
    ->middleware(['auth', 'admin']);
// Cualquier usuario autenticado: ver el listado
Route::resource('contribuyentes', ContribuyenteController::class)
    ->only(['index'])
    ->middleware('auth');

Route::get('/login', [AuthController::class, 'showLoginForm'])
    ->name('login');
Route::post('/login', [AuthController::class, 'login'])
    ->name('login.authenticate');

Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');
Route::post('/contribuyentes/validar-unicidad', [ContribuyenteController::class, 'validarUnicidad'])
    ->middleware(['auth', 'admin'])
    ->name('contribuyentes.validar-unicidad');
