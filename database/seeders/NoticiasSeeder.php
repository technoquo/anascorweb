<?php

namespace Database\Seeders;

use App\Models\Noticia;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class NoticiasSeeder extends Seeder
{
    public function run(): void
    {
        Storage::disk('public')->makeDirectory('noticias');

        $logoOrigen = public_path('logo/anascor.png');
        $logoDestino = 'noticias/anascor-placeholder.png';

        if (File::exists($logoOrigen)) {
            Storage::disk('public')->put($logoDestino, File::get($logoOrigen));
        }

        $noticias = [
            [
                'titulo' => 'ANASCOR celebra su 50 aniversario con gran fiesta comunitaria',
                'resumen' => 'La Asociación Nacional de Sordos de Costa Rica conmemoró cinco décadas de lucha por los derechos de la comunidad sorda con una emotiva celebración en San José.',
                'contenido' => '<p>El pasado 8 de junio, ANASCOR reunió a cientos de personas sordas, familias, amigos e instituciones aliadas para celebrar 50 años de historia, logros y compromiso con la comunidad sorda costarricense.</p><p>La celebración incluyó presentaciones artísticas en LESCO, reconocimientos a personas destacadas de la comunidad y un recorrido histórico por los principales hitos de la organización desde su fundación en 1974.</p><p>El presidente de ANASCOR destacó: "Cincuenta años no son nada si no miramos hacia el futuro con la misma energía y determinación de nuestros fundadores. Hoy celebramos el pasado y nos comprometemos con el presente y el futuro de nuestra comunidad."</p>',
                'publicado_en' => now()->subDays(30),
            ],
            [
                'titulo' => 'Nuevo convenio con Hellen AI impulsa tecnología para la comunidad sorda',
                'resumen' => 'ANASCOR firma alianza estratégica con empresa de inteligencia artificial para desarrollar herramientas de comunicación accesibles en LESCO.',
                'contenido' => '<p>En un paso significativo hacia la inclusión digital, ANASCOR formalizó un convenio de cooperación con Hellen AI, empresa especializada en inteligencia artificial aplicada a la comunicación en lengua de señas.</p><p>El acuerdo contempla el desarrollo de herramientas de traducción automática entre LESCO y español, aplicaciones móviles para el aprendizaje de la lengua de señas y sistemas de reconocimiento gestual para entornos públicos y de servicio al cliente.</p>',
                'publicado_en' => now()->subDays(45),
            ],
            [
                'titulo' => 'ANASCOR participa en el Día Internacional de la Lengua de Señas',
                'resumen' => 'El 23 de septiembre, Costa Rica se unió a la celebración mundial con actividades en San José y otras ciudades del país.',
                'contenido' => '<p>Con motivo del Día Internacional de la Lengua de Señas, establecido por la ONU para el 23 de septiembre, ANASCOR coordinó una serie de actividades en todo el país para visibilizar la importancia de la LESCO y promover su aprendizaje entre la población oyente.</p><p>Las actividades incluyeron talleres gratuitos de introducción a la LESCO, presentaciones en centros educativos y un encuentro cultural en el Teatro Nacional de San José.</p>',
                'publicado_en' => now()->subDays(60),
            ],
            [
                'titulo' => 'Comité de Educación presenta propuesta para intérpretes en universidades públicas',
                'resumen' => 'ANASCOR entrega al CONARE una propuesta formal para garantizar acceso a intérpretes de LESCO en todas las universidades estatales de Costa Rica.',
                'contenido' => '<p>El Comité de Educación de ANASCOR presentó ante el Consejo Nacional de Rectores (CONARE) una propuesta integral para la contratación permanente de intérpretes de LESCO en las cuatro universidades públicas del país.</p><p>La propuesta surge de testimonios de estudiantes sordos que enfrentan barreras comunicativas en el aula universitaria y busca garantizar el derecho a una educación superior en igualdad de condiciones.</p>',
                'publicado_en' => now()->subDays(75),
            ],
            [
                'titulo' => 'Apertura de nuevas academias de LESCO en Cartago y Heredia',
                'resumen' => 'La red de academias de Lengua de Señas Costarricense continúa expandiéndose con dos nuevos centros de enseñanza fuera de la Gran Área Metropolitana.',
                'contenido' => '<p>La red de academias de LESCO afiliadas a ANASCOR suma dos nuevos centros de enseñanza en Cartago y Heredia, respondiendo a la creciente demanda de aprendizaje de la lengua de señas en estas provincias.</p><p>Ambas academias ofrecerán cursos de nivel básico, intermedio y avanzado, además de talleres especiales para padres de niños sordos y profesionales de la salud y la educación.</p>',
                'publicado_en' => now()->subDays(90),
            ],
            [
                'titulo' => 'ANASCOR en el Congreso Mundial de la Federación Mundial de Sordos',
                'resumen' => 'Una delegación de ANASCOR participó en el congreso de la WFD representando a Costa Rica y compartiendo experiencias sobre legislación y accesibilidad.',
                'contenido' => '<p>Costa Rica estuvo representada en el Congreso de la Federación Mundial de Sordos (WFD) por una delegación de ANASCOR, que tuvo la oportunidad de compartir los avances del país en materia de reconocimiento de la LESCO y legislación de accesibilidad.</p><p>La participación en este foro internacional fortalece los vínculos de ANASCOR con organizaciones de sordos de todo el mundo y permite incorporar mejores prácticas en la defensa de derechos a nivel local.</p>',
                'publicado_en' => now()->subDays(120),
            ],
            [
                'titulo' => 'Campaña #AprendeLESCO supera las 10.000 personas capacitadas',
                'resumen' => 'La iniciativa de ANASCOR para promover el aprendizaje básico de la lengua de señas entre la población oyente alcanza un hito significativo.',
                'contenido' => '<p>La campaña #AprendeLESCO, impulsada por ANASCOR en colaboración con sus academias aliadas, celebra haber capacitado a más de 10.000 personas oyentes en nociones básicas de la Lengua de Señas Costarricense durante los últimos dos años.</p><p>La iniciativa utiliza talleres presenciales, contenido en redes sociales y una plataforma digital gratuita para acercar la LESCO a la mayor cantidad posible de ciudadanos, contribuyendo a una sociedad más inclusiva y comunicativa.</p>',
                'publicado_en' => now()->subDays(150),
            ],
            [
                'titulo' => 'ANASCOR impulsa acceso a servicios de salud con intérpretes en CCSS',
                'resumen' => 'Tras meses de gestiones, la Caja Costarricense de Seguro Social inicia programa piloto de intérpretes de LESCO en hospitales nacionales.',
                'contenido' => '<p>Fruto del trabajo sostenido del Comité de Salud de ANASCOR, la CCSS pone en marcha un programa piloto para garantizar acceso a intérpretes de LESCO en los principales hospitales nacionales durante la atención de pacientes sordos.</p><p>El programa, que inicia en el Hospital México y el Hospital San Juan de Dios, contempla la contratación de intérpretes certificados y la capacitación del personal médico y administrativo en comunicación básica con personas sordas.</p>',
                'publicado_en' => now()->subDays(180),
            ],
        ];

        foreach ($noticias as $data) {
            $slug = Str::slug($data['titulo']);
            $counter = 1;
            $baseSlug = $slug;

            while (Noticia::where('slug', $slug)->exists()) {
                $slug = $baseSlug.'-'.$counter++;
            }

            Noticia::create([
                'titulo' => $data['titulo'],
                'slug' => $slug,
                'resumen' => $data['resumen'],
                'contenido' => $data['contenido'],
                'imagen' => $logoDestino,
                'alt' => $data['titulo'],
                'publicado_en' => $data['publicado_en'],
                'activo' => true,
            ]);
        }
    }
}
