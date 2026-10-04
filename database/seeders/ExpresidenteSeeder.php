<?php

namespace Database\Seeders;

use App\Models\Expresidente;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ExpresidenteSeeder extends Seeder
{
    public function run(): void
    {
        Storage::disk('public')->makeDirectory('expresidentes');

        $expresidentes = [
            ['archivo' => 'diana - Copy.jpg', 'dest' => 'diana.jpg', 'nombre' => 'Diana Barahona', 'inicio' => 2020, 'fin' => 2024],
            ['archivo' => 'fernando - Copy.jpg', 'dest' => 'fernando.jpg', 'nombre' => 'Fernando Cascante', 'inicio' => 2016, 'fin' => 2020],
            ['archivo' => 'randall - Copy.jpg', 'dest' => 'randall.jpg', 'nombre' => 'Randall Mora', 'inicio' => 2012, 'fin' => 2016],
            ['archivo' => 'gerardo - Copy.jpg', 'dest' => 'gerardo.jpg', 'nombre' => 'Gerardo Rodríguez', 'inicio' => 2008, 'fin' => 2012],
            ['archivo' => 'maria - Copy.jpg', 'dest' => 'maria.jpg', 'nombre' => 'María de los Ángeles Ureña', 'inicio' => 2004, 'fin' => 2008],
            ['archivo' => 'juanpablo - Copy.png', 'dest' => 'juanpablo.png', 'nombre' => 'Juan Pablo Masís', 'inicio' => 2000, 'fin' => 2004],
            ['archivo' => 'rafael - Copy.png', 'dest' => 'rafael.png', 'nombre' => 'Rafael Solís', 'inicio' => 1996, 'fin' => 2000],
            ['archivo' => 'anascor1.png', 'dest' => 'fundador1.png', 'nombre' => 'Presidente Fundador', 'inicio' => 1974, 'fin' => 1980],
            ['archivo' => 'anascor3 - Copy.png', 'dest' => 'historico2.png', 'nombre' => 'Presidente Histórico II', 'inicio' => 1980, 'fin' => 1988],
            ['archivo' => 'anascor4 - Copy.png', 'dest' => 'historico3.png', 'nombre' => 'Presidente Histórico III', 'inicio' => 1988, 'fin' => 1996],
        ];

        foreach ($expresidentes as $index => $data) {
            $origen = public_path("exjunta/{$data['archivo']}");
            $destino = "expresidentes/{$data['dest']}";

            if (File::exists($origen)) {
                Storage::disk('public')->put($destino, File::get($origen));
            }

            Expresidente::create([
                'nombre' => $data['nombre'],
                'foto' => File::exists($origen) ? $destino : 'slides/anascor.png',
                'anio_inicio' => $data['inicio'],
                'anio_fin' => $data['fin'],
                'orden' => $index + 1,
            ]);
        }
    }
}
