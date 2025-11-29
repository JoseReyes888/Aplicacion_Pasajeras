<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ControllerUsuarios;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/usuarios', [ControllerUsuarios::class, 'index'])->name('usuarios');
Route::get('/registro', [App\Http\Controllers\ControllerRegistro::class, 'index'])->name('registro');
