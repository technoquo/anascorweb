<?php

namespace Database\Seeders;

use App\Models\Valor;
use Illuminate\Database\Seeder;

class ValorSeeder extends Seeder
{
    public function run(): void
    {
        $valores = [
            'Compromiso con las personas sordas',
            'Dignidad',
            'Responsabilidad',
            'Honestidad',
            'Transparencia',
            'Compromiso',
            'Excelencia',
            'Respeto',
            'Empatía',
            'Trabajo',
            'Disciplina',
            'Solidaridad',
            'Tolerancia',
        ];

        foreach ($valores as $index => $nombre) {
            Valor::create([
                'nombre' => $nombre,
                'orden' => $index + 1,
                'activo' => true,
            ]);
        }
    }
}
