<?php

namespace App\Repositories;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class UsuarioRepository
{
    protected string $archivo = 'data/usuarios.json';

    protected function path(): string
    {
        return storage_path('app/' . $this->archivo);
    }

    public function all(): Collection
    {
        if (!file_exists($this->path())) {
            $this->crearArchivoVacio();
        }

        $contenido = file_get_contents($this->path());
        return collect(json_decode($contenido, true));
    }

    protected function crearArchivoVacio(): void
    {
        $dir = dirname($this->path());
        if (!is_dir($dir)) mkdir($dir, 0755, true);
        file_put_contents($this->path(), '[]');
    }

    public function guardarTodos(Collection $usuarios): void
    {
        $fp = fopen($this->path(), 'c+');
        flock($fp, LOCK_EX);
        ftruncate($fp, 0);
        fwrite($fp, $usuarios->toJson(JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
        fflush($fp);
        flock($fp, LOCK_UN);
        fclose($fp);
    }

    public function crear(array $datos): void
    {
        $usuarios = $this->all();

        // Validaciones únicas
        if ($usuarios->firstWhere('username', $datos['username'] ?? '')) {
            throw new \Exception('El nombre de usuario ya existe');
        }
        if ($usuarios->firstWhere('email', $datos['email'] ?? '')) {
            throw new \Exception('El correo ya está registrado');
        }

        $datos = array_merge([
            'id'            => (string) Str::uuid(),
            'username'      => '',
            'password'      => '',
            'email'         => '',
            'nombre'        => '',
            'apellido_p'    => '',
            'apellido_m'    => '',
            'sexo'          => null,
            'edad'          => null,
            'tipo_usuario'  => 'checador',
            'estado'        => 'activo',
            'created_at'    => now()->format('Y-m-d H:i:s'),
            'updated_at'    => now()->format('Y-m-d H:i:s'),
        ], $datos);

        if (!empty($datos['password'])) {
            $datos['password'] = Hash::make($datos['password']);
        }

        $usuarios->push($datos);
        $this->guardarTodos($usuarios);
    }

    public function actualizar(string $id, array $datos): bool
    {
        $usuarios = $this->all();
        $indice = $usuarios->search(fn($u) => $u['id'] === $id);

        if ($indice === false) return false;

        if (!empty($datos['password'])) {
            $datos['password'] = Hash::make($datos['password']);
        } else {
            unset($datos['password']);
        }

        $usuarios[$indice] = array_merge($usuarios[$indice], $datos, [
            'updated_at' => now()->format('Y-m-d H:i:s')
        ]);

        $this->guardarTodos($usuarios);
        return true;
    }

    public function encontrar(string $id)
    {
        return $this->all()->firstWhere('id', $id);
    }

    public function porUsername(string $username)
    {
        return $this->all()->firstWhere('username', $username);
    }
}