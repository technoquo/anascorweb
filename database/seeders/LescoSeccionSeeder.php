<?php

namespace Database\Seeders;

use App\Models\LescoSeccion;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class LescoSeccionSeeder extends Seeder
{
    public function run(): void
    {
        $secciones = [
            [
                'titulo' => 'Legislación de LESCO',
                'descripcion' => 'La Lengua de Señas Costarricense (LESCO) está reconocida oficialmente por la Ley 7600 de Igualdad de Oportunidades para las Personas con Discapacidad y la Ley 8661 de Convención sobre los Derechos de las Personas con Discapacidad. Estas leyes garantizan el derecho de las personas sordas a comunicarse en su lengua natural y a recibir servicios de interpretación en espacios públicos y educativos.',
            ],
            [
                'titulo' => 'Día de la LESCO',
                'descripcion' => 'El Día de la LESCO se celebra cada año el 1 de octubre en Costa Rica. Esta fecha conmemora el reconocimiento oficial de la Lengua de Señas Costarricense como lengua propia de la comunidad sorda del país. ANASCOR organiza actividades educativas y culturales para difundir el conocimiento de LESCO entre la población oyente.',
            ],
            [
                'titulo' => 'Día Internacional de la Lengua de Señas',
                'descripcion' => 'El 23 de septiembre de cada año se celebra el Día Internacional de la Lengua de Señas, fecha establecida por la Asamblea General de las Naciones Unidas en 2017. Esta celebración coincide con el aniversario de la fundación de la Federación Mundial de Sordos (WFD) en 1951 y busca promover la diversidad lingüística y el apoyo a la identidad cultural de todas las personas sordas y con deficiencia auditiva.',
            ],
        ];

        foreach ($secciones as $index => $seccion) {
            LescoSeccion::create([
                'titulo' => $seccion['titulo'],
                'slug' => Str::slug($seccion['titulo']),
                'descripcion' => $seccion['descripcion'],
                'orden' => $index + 1,
                'activo' => true,
            ]);
        }
    }
}
