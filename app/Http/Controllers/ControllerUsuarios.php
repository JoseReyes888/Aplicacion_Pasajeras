<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;           // ← AÑADE ESTA LÍNEA
use App\Repositories\UsuarioRepository;   // ← AÑADIR ESTO

class ControllerUsuarios extends Controller
{
    protected $repo;

    // Inyectamos el repositorio para usar el JSON
    public function __construct(UsuarioRepository $repo)
    {
        $this->repo = $repo;
    }

    public function index()
    {
        // ← ESTO ES LO QUE FALTABA: cargar los usuarios del JSON
        $usuarios = $this->repo->all();

        // Enviamos la variable a la vista
        return view('administrador.usuarios', compact('usuarios'));
    }

    // =============== CRUD (crear y actualizar) ===============
    public function store(Request $request)
    {
        $request->validate([
            'username'   => 'required|alpha_dash|min:3',
            'email'      => 'required|email',
            'password'   => 'required|min:6',
            'nombre'     => 'required',
            'apellido_p' => 'required',
        ]);

        try {
            $this->repo->crear($request->all());
            return back()->with('success', 'Usuario creado correctamente');
        } catch (\Exception $e) {
            return back()->withErrors($e->getMessage());
        }
    }

    public function edit($id)
    {
        $usuario = $this->repo->encontrar($id);
        return response()->json($usuario ?? ['error' => 'No encontrado']);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'username'   => 'required',
            'email'      => 'required|email',
            'nombre'     => 'required',
            'apellido_p' => 'required',
        ]);

        $this->repo->actualizar($id, $request->all());
        return back()->with('success', 'Usuario actualizado correctamente');
    }
}