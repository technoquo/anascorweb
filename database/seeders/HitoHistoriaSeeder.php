<?php

namespace Database\Seeders;

use App\Models\HitoHistoria;
use Illuminate\Database\Seeder;

class HitoHistoriaSeeder extends Seeder
{
    public function run(): void
    {
        $hitos = [
            [
                'anio' => 1974,
                'titulo' => 'Fundación de ANASCOR',
                'descripcion' => 'El 8 de junio de 1974, un grupo de personas sordas visionarias fundaron la Asociación Nacional de Sordos de Costa Rica con el firme propósito de defender sus derechos y construir una comunidad organizada.',
                'orden' => 1,
            ],
            [
                'anio' => 1985,
                'titulo' => 'Primer congreso nacional de personas sordas',
                'descripcion' => 'ANASCOR organiza el primer congreso nacional de personas sordas, reuniendo a representantes de todo el país para establecer prioridades en materia de educación y derechos.',
                'orden' => 2,
            ],
            [
                'anio' => 1996,
                'titulo' => 'Reconocimiento de la LESCO en la Ley 7600',
                'descripcion' => 'La promulgación de la Ley de Igualdad de Oportunidades para Personas con Discapacidad (Ley 7600) reconoce oficialmente la Lengua de Señas Costarricense como lengua propia de la comunidad sorda.',
                'orden' => 3,
            ],
            [
                'anio' => 2001,
                'titulo' => 'Afiliación a la Federación Mundial de Sordos',
                'descripcion' => 'ANASCOR se afilia oficialmente a la World Federation of the Deaf (WFD), consolidando su presencia en el escenario internacional y accediendo a redes globales de defensa de derechos.',
                'orden' => 4,
            ],
            [
                'anio' => 2008,
                'titulo' => 'Ratificación de la Convención sobre Derechos de las Personas con Discapacidad',
                'descripcion' => 'Costa Rica ratifica la Convención de la ONU sobre los Derechos de las Personas con Discapacidad (Ley 8661), reforzando el marco legal para la protección de los derechos de las personas sordas.',
                'orden' => 5,
            ],
            [
                'anio' => 2015,
                'titulo' => 'Lanzamiento del programa de academias de LESCO',
                'descripcion' => 'ANASCOR impulsa la creación de una red de academias para la enseñanza de LESCO a personas oyentes, ampliando el acceso a la lengua de señas en toda Costa Rica.',
                'orden' => 6,
            ],
            [
                'anio' => 2019,
                'titulo' => 'Primer Día Nacional de la LESCO',
                'descripcion' => 'Se celebra por primera vez el 1 de octubre como Día Nacional de la LESCO, fecha establecida para visibilizar y promover el uso de la Lengua de Señas Costarricense.',
                'orden' => 7,
            ],
            [
                'anio' => 2024,
                'titulo' => '50 aniversario de ANASCOR',
                'descripcion' => 'ANASCOR celebra su 50 aniversario con una gran fiesta que reunió a cientos de miembros de la comunidad sorda, sus familias y aliados, reafirmando el compromiso con los derechos y el bienestar de las personas sordas de Costa Rica.',
                'orden' => 8,
            ],
        ];

        foreach ($hitos as $hito) {
            HitoHistoria::create($hito);
        }
    }
}
