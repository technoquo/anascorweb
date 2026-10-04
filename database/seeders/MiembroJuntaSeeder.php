<?php

namespace Database\Seeders;

use App\Models\MiembroJunta;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class MiembroJuntaSeeder extends Seeder
{
    public function run(): void
    {
        Storage::disk('public')->makeDirectory('junta');

        $miembros = [
            ['archivo' => 'alexandra.jpg', 'nombre' => 'Alexandra Rodríguez', 'puesto' => 'Presidenta'],
            ['archivo' => 'carlosgutierrez.jpg', 'nombre' => 'Carlos Gutiérrez', 'puesto' => 'Vicepresidente'],
            ['archivo' => 'carolina.jpg', 'nombre' => 'Carolina Méndez', 'puesto' => 'Secretaria'],
            ['archivo' => 'joel.jpg', 'nombre' => 'Joel Salas', 'puesto' => 'Tesorero'],
            ['archivo' => 'josue.jpg', 'nombre' => 'Josué Vargas', 'puesto' => 'Vocal I'],
            ['archivo' => 'juanchy.jpg', 'nombre' => 'Juan Carlos Solís', 'puesto' => 'Vocal II'],
            ['archivo' => 'juandiego.jpg', 'nombre' => 'Juan Diego Mora', 'puesto' => 'Vocal III'],
            ['archivo' => 'lileana.jpg', 'nombre' => 'Lileana Castro', 'puesto' => 'Vocal IV'],
            ['archivo' => 'luisdiego.jpg', 'nombre' => 'Luis Diego Quesada', 'puesto' => 'Vocal V'],
            ['archivo' => 'maxwell.jpg', 'nombre' => 'Maxwell López', 'puesto' => 'Fiscal'],
            ['archivo' => 'milena.jpg', 'nombre' => 'Milena Arce', 'puesto' => 'Suplente I'],
            ['archivo' => 'olga.jpg', 'nombre' => 'Olga Ureña', 'puesto' => 'Suplente II'],
            ['archivo' => 'vargas.jpg', 'nombre' => 'Manuel Vargas', 'puesto' => 'Suplente III'],
            ['archivo' => 'victor.jpg', 'nombre' => 'Víctor Jiménez', 'puesto' => 'Suplente IV'],
        ];

        foreach ($miembros as $index => $data) {
            $origen = public_path("junta/{$data['archivo']}");
            $destino = "junta/{$data['archivo']}";

            if (File::exists($origen)) {
                Storage::disk('public')->put($destino, File::get($origen));
            }

            MiembroJunta::create([
                'nombre' => $data['nombre'],
                'puesto' => $data['puesto'],
                'foto' => File::exists($origen) ? $destino : 'slides/anascor.png',
                'periodo' => '2024-2026',
                'orden' => $index + 1,
                'activo' => true,
            ]);
        }
    }
}
