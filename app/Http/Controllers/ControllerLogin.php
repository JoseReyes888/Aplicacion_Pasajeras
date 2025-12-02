<?php

namespace App\Http\Controllers;

use App\Repositories\UsuarioRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ControllerLogin extends Controller
{
    protected $repo;

    public function __construct(UsuarioRepository $repo)
    {
        $this->repo = $repo;
    }

    // Muestra el login (tu welcome.blade.php)
    public function login()
    {
        if (session('user')) {
            return redirect()->route('usuarios.index');
        }
        return view('welcome');   // ← TU VISTA DE LOGIN
    }

    // Procesa el intento de login
    public function attempt(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $usuario = $this->repo->porUsername($request->username);

        if ($usuario && Hash::check($request->password, $usuario['password']) && $usuario['estado'] === 'activo') {
            session(['user' => $usuario]);
            return redirect()->route('usuarios.index');
        }

        return back()->withErrors('Usuario o contraseña incorrectos');
    }

    // Cerrar sesión
    public function logout()
    {
        session()->forget('user');
        return redirect()->route('login')->with('success', 'Sesión cerrada');
    }
}