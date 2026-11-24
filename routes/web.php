<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\GuardiaController;
use App\Http\Controllers\ActividadController;
use App\Http\Controllers\CertificadoController;

Route::get('/', function () {
    return redirect()->route('login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('guardias', GuardiaController::class);
Route::resource('actividades', ActividadController::class);
Route::resource('certificados', CertificadoController::class)->except(['edit', 'update']);