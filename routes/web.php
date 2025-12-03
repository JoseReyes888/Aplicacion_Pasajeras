<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ControllerLogin;
use App\Http\Controllers\ControllerUsuarios;

// ========== LOGIN ==========
Route::get('/login', [ControllerLogin::class, 'login'])->name('login');
Route::post('/login', [ControllerLogin::class, 'attempt']);
Route::post('/logout', [ControllerLogin::class, 'logout'])->name('logout');

// ========== RUTAS PROTEGIDAS ==========
Route::middleware('auth.json')->group(function () {

    // Página principal
    Route::get('/', [ControllerUsuarios::class, 'index'])->name('usuarios.index');
    Route::get('/usuarios', [ControllerUsuarios::class, 'index'])->name('usuarios');

    // CREAR usuario → POST a /usuarios
    Route::post('/usuarios', [ControllerUsuarios::class, 'store'])->name('usuarios.store');

    // EDITAR: obtener datos (GET)
    Route::get('/usuarios/{id}/edit', [ControllerUsuarios::class, 'edit']);

    // ACTUALIZAR usuario → Acepta tanto PUT como POST (para formularios HTML)
    Route::match(['PUT', 'PATCH', 'POST'], '/usuarios/{id}', [ControllerUsuarios::class, 'update'])
         ->name('usuarios.update');

    // Tu otra vista
    Route::get('/registro', [App\Http\Controllers\ControllerRegistro::class, 'index'])->name('registro');
    Route::get('/mostrarRegistro', [App\Http\Controllers\ControllerMostrarRegistro::class, 'index'])->name('mostrarRegistro');

    Route::get('/mostrar-registro', [App\Http\Controllers\ControllerMostrarRegistro::class, 'index'])
     ->name('mostrar.registro')
     ->middleware('auth.json'); // o el middleware que uses

});