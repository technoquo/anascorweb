<?php

namespace Database\Seeders;

use App\Models\Slide;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class SlideSeeder extends Seeder
{
    public function run(): void
    {
        Storage::disk('public')->makeDirectory('slides');

        $logoOrigen = public_path('logo/anascor.png');
        $logoDestino = 'slides/anascor.png';

        if (File::exists($logoOrigen)) {
            Storage::disk('public')->put($logoDestino, File::get($logoOrigen));
        }

        $slides = [
            [
                'titulo' => '50 años defendiendo los derechos de la comunidad sorda',
                'imagen' => $logoDestino,
                'alt' => 'Logo de ANASCOR — 50 años',
                'enlace' => '/anascor/quienes-somos',
                'orden' => 1,
            ],
            [
                'titulo' => 'Promovemos la Lengua de Señas Costarricense',
                'imagen' => $logoDestino,
                'alt' => 'Promoción de LESCO',
                'enlace' => '/lesco',
                'orden' => 2,
            ],
            [
                'titulo' => 'Únete a nuestra comunidad',
                'imagen' => $logoDestino,
                'alt' => 'Comunidad ANASCOR',
                'enlace' => '/contacto',
                'orden' => 3,
            ],
        ];

        foreach ($slides as $slide) {
            Slide::create($slide);
        }
    }
}
