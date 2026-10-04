<?php

namespace Database\Seeders;

use App\Models\Academia;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class AcademiaSeeder extends Seeder
{
    public function run(): void
    {
        Storage::disk('public')->makeDirectory('academias');

        $academias = [
            ['archivo' => 'abilesco.png', 'nombre' => 'Abilesco', 'url' => 'https://abilesco.com'],
            ['archivo' => 'CILESCO.png', 'nombre' => 'CILESCO', 'url' => 'https://cilesco.com'],
            ['archivo' => 'COMULESCO.png', 'nombre' => 'COMULESCO', 'url' => 'https://comulesco.com'],
            ['archivo' => 'ensenas.png', 'nombre' => 'Enséñas', 'url' => 'https://ensenas.com'],
            ['archivo' => 'fms.png', 'nombre' => 'FMS Academia', 'url' => 'https://fmsacademia.com'],
            ['archivo' => 'handson.png', 'nombre' => 'Hands On', 'url' => 'https://handsonlesco.com'],
            ['archivo' => 'ILESCO.jpg', 'nombre' => 'ILESCO', 'url' => 'https://ilesco.com'],
            ['archivo' => 'INLesco.png', 'nombre' => 'INLesco', 'url' => 'https://inlesco.com'],
            ['archivo' => 'lescocultura.png', 'nombre' => 'LESCO Cultura', 'url' => 'https://lescocultura.com'],
            ['archivo' => 'lescoporcostarica.png', 'nombre' => 'LESCO por Costa Rica', 'url' => 'https://lescoporcostarica.com'],
        ];

        foreach ($academias as $index => $data) {
            $origen = public_path("logo/{$data['archivo']}");
            $destino = "academias/{$data['archivo']}";

            if (File::exists($origen)) {
                Storage::disk('public')->put($destino, File::get($origen));
            }

            Academia::create([
                'nombre' => $data['nombre'],
                'imagen' => File::exists($origen) ? $destino : 'slides/anascor.png',
                'url' => $data['url'],
                'status' => 1,
                'orden' => $index + 1,
            ]);
        }
    }
}
