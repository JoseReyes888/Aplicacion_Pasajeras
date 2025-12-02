<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AuthJson
{
    public function handle(Request $request, Closure $next)
    {
        // Si no hay usuario en sesión → redirige al login
        if (!session('user')) {
            return redirect()->route('login');
        }

        // Opcional: si quieres que solo administradores accedan a ciertas partes
        $user = session('user');
        if ($user['estado'] !== 'activo') {
            session()->flush();
            return redirect()->route('login')->withErrors('Tu cuenta está inactiva');
        }

        return $next($request);
    }
}