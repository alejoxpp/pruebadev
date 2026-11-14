<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContribuyenteController;
use App\Http\Controllers\AuthController;

Route::get('/', [ContribuyenteController::class, 'index'])->middleware('auth');

Route::resource('contribuyentes',ContribuyenteController::class)->middleware('auth');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.authenticate');
