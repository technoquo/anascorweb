<?php

namespace Database\Seeders;

use App\Models\Comite;
use App\Models\ComiteMiembro;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ComiteSeeder extends Seeder
{
    public function run(): void
    {
        Storage::disk('public')->makeDirectory('comites');

        $logoOrigen = public_path('logo/anascor.png');
        $logoDestino = 'comites/logo-placeholder.png';

        if (File::exists($logoOrigen)) {
            Storage::disk('public')->put($logoDestino, File::get($logoOrigen));
        }

        $comites = [
            [
                'nombre' => 'Comité de Educación',
                'descripcion' => 'El Comité de Educación de ANASCOR trabaja por garantizar el acceso de niños y jóvenes sordos a una educación bilingüe de calidad en LESCO y español escrito. Coordina con el Ministerio de Educación Pública y otras instituciones para promover la formación de intérpretes y la inclusión educativa.',
                'miembros' => [
                    ['nombre' => 'Laura Jiménez', 'cargo' => 'Coordinadora', 'descripcion' => 'Especialista en educación bilingüe para personas sordas con 15 años de experiencia.'],
                    ['nombre' => 'Roberto Campos', 'cargo' => 'Secretario', 'descripcion' => 'Docente de LESCO e intérprete certificado.'],
                    ['nombre' => 'Ana Villalobos', 'cargo' => 'Vocal', 'descripcion' => 'Madre de niña sorda y defensora de la educación inclusiva.'],
                ],
            ],
            [
                'nombre' => 'Comité de Salud',
                'descripcion' => 'El Comité de Salud vela por el acceso equitativo de las personas sordas a los servicios de salud, promoviendo la contratación de intérpretes en hospitales y clínicas de la CCSS, y la capacitación del personal médico en comunicación con pacientes sordos.',
                'miembros' => [
                    ['nombre' => 'Carlos Elizondo', 'cargo' => 'Coordinador', 'descripcion' => 'Enfermero sordo con experiencia en gestión hospitalaria.'],
                    ['nombre' => 'Stephanie Mora', 'cargo' => 'Secretaria', 'descripcion' => 'Trabajadora social especializada en discapacidad.'],
                ],
            ],
            [
                'nombre' => 'Comité Cultural',
                'descripcion' => 'El Comité Cultural promueve la identidad y el patrimonio de la cultura sorda costarricense a través de eventos artísticos, deportivos y sociales. Organiza el festival anual de cultura sorda y coordina actividades de integración para toda la comunidad.',
                'miembros' => [
                    ['nombre' => 'Mariana Solano', 'cargo' => 'Coordinadora', 'descripcion' => 'Artista y promotora cultural de la comunidad sorda.'],
                    ['nombre' => 'Diego Brenes', 'cargo' => 'Secretario', 'descripcion' => 'Fotógrafo y documentalista de eventos comunitarios.'],
                    ['nombre' => 'Patricia Núñez', 'cargo' => 'Vocal', 'descripcion' => 'Intérprete de LESCO y gestora cultural.'],
                ],
            ],
        ];

        foreach ($comites as $index => $data) {
            $comite = Comite::create([
                'nombre' => $data['nombre'],
                'slug' => Str::slug($data['nombre']),
                'logo' => $logoDestino,
                'descripcion' => $data['descripcion'],
                'orden' => $index + 1,
                'activo' => true,
            ]);

            foreach ($data['miembros'] as $miembroIndex => $miembro) {
                ComiteMiembro::create([
                    'comite_id' => $comite->id,
                    'nombre' => $miembro['nombre'],
                    'cargo' => $miembro['cargo'],
                    'descripcion' => $miembro['descripcion'],
                    'orden' => $miembroIndex + 1,
                ]);
            }
        }
    }
}
