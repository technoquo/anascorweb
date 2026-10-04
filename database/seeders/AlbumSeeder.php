<?php

namespace Database\Seeders;

use App\Models\Album;
use App\Models\Foto;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AlbumSeeder extends Seeder
{
    public function run(): void
    {
        $origen = public_path('galleria/fiesta_anascor_50');
        $destino = 'galleria/fiesta_anascor_50';

        Storage::disk('public')->makeDirectory($destino);

        $archivos = collect(File::files($origen))
            ->filter(fn ($f) => in_array(strtolower($f->getExtension()), ['jpg', 'jpeg', 'png', 'webp']))
            ->sortBy(fn ($f) => $f->getFilename())
            ->values();

        if ($archivos->isEmpty()) {
            return;
        }

        $portadaOrigen = $archivos->first();
        $portadaNombre = Str::ascii($portadaOrigen->getFilename());
        $portadaRuta = "{$destino}/{$portadaNombre}";

        Storage::disk('public')->put($portadaRuta, File::get($portadaOrigen->getPathname()));

        $album = Album::create([
            'titulo' => '50 Aniversario de ANASCOR',
            'slug' => '50-aniversario-de-anascor',
            'anio' => 2024,
            'portada' => $portadaRuta,
            'descripcion' => 'Galería fotográfica de la celebración del 50 aniversario de la Asociación Nacional de Sordos de Costa Rica, realizada el 8 de junio de 2024. Fotografías de Aucarea Photography.',
            'activo' => true,
        ]);

        foreach ($archivos as $index => $archivo) {
            $nombreLimpio = Str::ascii($archivo->getFilename());
            $rutaDestino = "{$destino}/{$nombreLimpio}";

            Storage::disk('public')->put($rutaDestino, File::get($archivo->getPathname()));

            Foto::create([
                'album_id' => $album->id,
                'imagen' => $rutaDestino,
                'alt' => 'Celebración 50 aniversario de ANASCOR — foto '.($index + 1),
                'orden' => $index + 1,
            ]);
        }
    }
}
