<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\File;

class ControllerMostrarRegistro extends Controller
{
    public function index()
    {
        // === CARGAR CHOFERES ===
        $choferes = [];
        $choferPath = storage_path('app/data/chofer.json');
        if (File::exists($choferPath)) {
            $json = json_decode(File::get($choferPath), true);
            if (isset($json['choferes']) && is_array($json['choferes'])) {
                foreach ($json['choferes'] as $chofer) {
                    if (($chofer['metadatos']['activo'] ?? false)) {
                        $choferes[] = $chofer;
                    }
                }
            }
        }

        // === CARGAR UNIDADES ===
        $unidades = [];
        $unidadPath = storage_path('app/data/unidad.json');
        if (File::exists($unidadPath)) {
            $json = json_decode(File::get($unidadPath), true);
            if (isset($json['unidades']) && is_array($json['unidades'])) {
                foreach ($json['unidades'] as $unidad) {
                    if (($unidad['metadatos']['activo'] ?? false)) {
                        $unidades[] = $unidad;
                    }
                }
            }
        }

        return view('administrador.mostrar_registro', compact('choferes', 'unidades'));
    }
}