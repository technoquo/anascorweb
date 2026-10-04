<?php

namespace Database\Seeders;

use App\Models\Convenio;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ConvenioSeeder extends Seeder
{
    public function run(): void
    {
        Storage::disk('public')->makeDirectory('convenios');

        $convenios = [
            [
                'archivo' => 'helenai_logo.jpg',
                'nombre' => 'Hellen AI',
                'descripcion' => 'Convenio con Hellen AI para el desarrollo de tecnología de inteligencia artificial aplicada a la interpretación y traducción automática de la Lengua de Señas Costarricense (LESCO), facilitando la comunicación entre personas sordas y oyentes.',
                'url' => 'https://hellenai.com',
            ],
            [
                'archivo' => 'signbridge.jpg',
                'nombre' => 'SignBridge',
                'descripcion' => 'Alianza con SignBridge, plataforma tecnológica que desarrolla soluciones innovadoras de comunicación en lengua de señas, contribuyendo a la accesibilidad digital para la comunidad sorda costarricense.',
                'url' => 'https://signbridge.com',
            ],
        ];

        foreach ($convenios as $index => $data) {
            $origen = public_path("logo/{$data['archivo']}");
            $destino = "convenios/{$data['archivo']}";

            if (File::exists($origen)) {
                Storage::disk('public')->put($destino, File::get($origen));
            }

            Convenio::create([
                'nombre' => $data['nombre'],
                'descripcion' => $data['descripcion'],
                'imagen' => File::exists($origen) ? $destino : 'slides/anascor.png',
                'url' => $data['url'],
                'status' => 1,
                'orden' => $index + 1,
            ]);
        }
    }
}
