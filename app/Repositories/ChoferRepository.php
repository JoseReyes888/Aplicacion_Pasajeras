<?php

namespace App\Repositories;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;

class ChoferRepository
{
    protected string $archivo = 'data/choferes.json';

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
        file_put_contents($this->path(), '{"choferes": []}');
    }

    public function guardarTodos(Collection $choferes): void
    {
        $data = ['choferes' => $choferes->toArray()];
        $fp = fopen($this->path(), 'c+');
        flock($fp, LOCK_EX);
        ftruncate($fp, 0);
        fwrite($fp, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
        fflush($fp);
        flock($fp, LOCK_UN);
        fclose($fp);
    }

    public function crear(array $datos): string
    {
        $choferes = $this->all();

        // Validar CURP único
        if ($choferes->firstWhere('informacion_personal.curp', $datos['informacion_personal']['curp'] ?? '')) {
            throw new \Exception('El CURP ya está registrado');
        }

        // Generar ID secuencial
        $ultimoId = $choferes->max('id');
        $nuevoNumero = $ultimoId ? ((int)$ultimoId + 1) : 1;
        $id = $nuevoNumero;

        // Estructura completa del chofer
        $chofer = [
            'id' => $id,
            'informacion_personal' => [
                'nombres' => $datos['informacion_personal']['nombres'] ?? '',
                'apellidos' => $datos['informacion_personal']['apellidos'] ?? '',
                'curp' => $datos['informacion_personal']['curp'] ?? '',
                'rfc' => $datos['informacion_personal']['rfc'] ?? '',
                'fecha_nacimiento' => $datos['informacion_personal']['fecha_nacimiento'] ?? '',
                'sexo' => $datos['informacion_personal']['sexo'] ?? '',
            ],
            'informacion_contacto' => [
                'telefono' => $datos['informacion_contacto']['telefono'] ?? '',
                'correo_electronico' => $datos['informacion_contacto']['correo_electronico'] ?? '',
                'direccion' => $datos['informacion_contacto']['direccion'] ?? '',
            ],
            'informacion_licencia' => [
                'numero_licencia' => $datos['informacion_licencia']['numero_licencia'] ?? '',
                'tipo_licencia' => $datos['informacion_licencia']['tipo_licencia'] ?? '',
                'vencimiento_licencia' => $datos['informacion_licencia']['vencimiento_licencia'] ?? '',
                'anios_experiencia' => $datos['informacion_licencia']['anios_experiencia'] ?? 0,
            ],
            'informacion_laboral' => [
                'fecha_contratacion' => $datos['informacion_laboral']['fecha_contratacion'] ?? '',
                'estado' => $datos['informacion_laboral']['estado'] ?? 'activo',
                'contacto_emergencia' => $datos['informacion_laboral']['contacto_emergencia'] ?? '',
                'telefono_emergencia' => $datos['informacion_laboral']['telefono_emergencia'] ?? '',
            ],
            'metadatos' => [
                'fecha_registro' => now()->format('Y-m-d\TH:i:s\Z'),
                'ultima_actualizacion' => now()->format('Y-m-d\TH:i:s\Z'),
                'registrado_por' => auth()->user()->name ?? 'Administrador',
                'activo' => true,
            ]
        ];

        $choferes->push($chofer);
        $this->guardarTodos($choferes);
        return $id;
    }

    public function actualizar(int $id, array $datos): bool
    {
        $choferes = $this->all();
        $indice = $choferes->search(fn($c) => $c['id'] === $id);

        if ($indice === false) return false;

        // Actualizar campos
        foreach ($datos as $categoria => $valores) {
            if (isset($choferes[$indice][$categoria])) {
                $choferes[$indice][$categoria] = array_merge(
                    $choferes[$indice][$categoria],
                    $valores
                );
            }
        }

        // Actualizar metadatos
        $choferes[$indice]['metadatos']['ultima_actualizacion'] = now()->format('Y-m-d\TH:i:s\Z');

        $this->guardarTodos($choferes);
        return true;
    }

    public function encontrar(int $id)
    {
        return $this->all()->firstWhere('id', $id);
    }

    public function buscarPorCURP(string $curp)
    {
        return $this->all()->firstWhere('informacion_personal.curp', $curp);
    }

    public function eliminar(int $id): bool
    {
        $choferes = $this->all();
        $indice = $choferes->search(fn($c) => $c['id'] === $id);

        if ($indice === false) return false;

        // Cambiar estado a inactivo en lugar de eliminar
        $choferes[$indice]['informacion_laboral']['estado'] = 'inactivo';
        $choferes[$indice]['metadatos']['activo'] = false;
        $choferes[$indice]['metadatos']['ultima_actualizacion'] = now()->format('Y-m-d\TH:i:s\Z');

        $this->guardarTodos($choferes);
        return true;
    }

    public function obtenerActivos(): Collection
    {
        return $this->all()->filter(function ($chofer) {
            return $chofer['informacion_laboral']['estado'] === 'activo' &&
                   $chofer['metadatos']['activo'] === true;
        });
    }

    public function contar(): int
    {
        return $this->all()->count();
    }

    public function contarActivos(): int
    {
        return $this->obtenerActivos()->count();
    }
}