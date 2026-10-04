<?php

namespace Database\Seeders;

use App\Models\Comite;
use App\Models\Evento;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class EventoSeeder extends Seeder
{
    public function run(): void
    {
        $comiteEducacion = Comite::where('nombre', 'Comité de Educación')->first();
        $comiteCultural = Comite::where('nombre', 'Comité Cultural')->first();
        $comiteSalud = Comite::where('nombre', 'Comité de Salud')->first();

        $eventos = [
            [
                'nombre' => 'Taller Introductorio de LESCO — Noviembre 2026',
                'descripcion' => 'Taller gratuito de introducción a la Lengua de Señas Costarricense dirigido a personas oyentes. Aprenderás el vocabulario básico, el abecedario dactilológico y frases cotidianas. No se requiere experiencia previa.',
                'lugar' => 'Sede de ANASCOR, Barrio Escalante, San José',
                'inicia_en' => now()->addDays(14)->setTime(9, 0),
                'termina_en' => now()->addDays(14)->setTime(12, 0),
                'comite_id' => $comiteEducacion?->id,
            ],
            [
                'nombre' => 'Asamblea General Ordinaria de Asociados 2026',
                'descripcion' => 'Convocatoria a la Asamblea General Ordinaria de Personas Asociadas de ANASCOR. Se presentarán los informes de gestión, estados financieros y se votará sobre los temas del orden del día.',
                'lugar' => 'Auditorio ANASCOR, Barrio Escalante, San José',
                'inicia_en' => now()->addDays(21)->setTime(10, 0),
                'termina_en' => now()->addDays(21)->setTime(13, 0),
                'comite_id' => null,
            ],
            [
                'nombre' => 'Festival Cultural Sordo — Diciembre 2026',
                'descripcion' => 'El Festival Cultural Sordo reúne a artistas, bailarines y narradores de la comunidad sorda en un espectáculo único. La presentación incluye teatro en LESCO, danza y exposición fotográfica. Entrada libre.',
                'lugar' => 'Teatro Melico Salazar, San José',
                'inicia_en' => now()->addDays(45)->setTime(15, 0),
                'termina_en' => now()->addDays(45)->setTime(20, 0),
                'comite_id' => $comiteCultural?->id,
            ],
            [
                'nombre' => 'Charla: Acceso a Servicios de Salud para Personas Sordas',
                'descripcion' => 'El Comité de Salud de ANASCOR organiza esta charla informativa sobre los derechos de las personas sordas en el sistema de salud costarricense y cómo acceder al servicio de intérpretes en hospitales de la CCSS.',
                'lugar' => 'Hospital México, San José (Sala de Conferencias)',
                'inicia_en' => now()->addDays(30)->setTime(14, 0),
                'termina_en' => now()->addDays(30)->setTime(16, 0),
                'comite_id' => $comiteSalud?->id,
            ],
            [
                'nombre' => 'Encuentro de Padres de Niños Sordos',
                'descripcion' => 'Espacio de apoyo y formación para padres y madres de niños sordos. Se abordarán temas de crianza bilingüe (LESCO/español escrito), recursos educativos disponibles y redes de apoyo comunitario.',
                'lugar' => 'Sede de ANASCOR, Barrio Escalante, San José',
                'inicia_en' => now()->addDays(60)->setTime(8, 30),
                'termina_en' => now()->addDays(60)->setTime(12, 0),
                'comite_id' => $comiteEducacion?->id,
            ],
            [
                'nombre' => 'Día de la LESCO 2025 — Celebración Nacional',
                'descripcion' => 'Actividades conmemorativas del Día Nacional de la LESCO el 1 de octubre. Desfile por el centro de San José, talleres abiertos al público y activación en redes sociales con el hashtag #DíaDeLaLESCO.',
                'lugar' => 'Parque Central, San José',
                'inicia_en' => now()->subDays(5)->setTime(10, 0),
                'termina_en' => now()->subDays(5)->setTime(17, 0),
                'comite_id' => null,
            ],
        ];

        foreach ($eventos as $data) {
            $slug = Str::slug($data['nombre']);
            $counter = 1;
            $baseSlug = $slug;

            while (Evento::where('slug', $slug)->exists()) {
                $slug = $baseSlug.'-'.$counter++;
            }

            Evento::create([
                'nombre' => $data['nombre'],
                'slug' => $slug,
                'descripcion' => $data['descripcion'],
                'lugar' => $data['lugar'],
                'inicia_en' => $data['inicia_en'],
                'termina_en' => $data['termina_en'],
                'comite_id' => $data['comite_id'],
                'activo' => true,
            ]);
        }
    }
}
