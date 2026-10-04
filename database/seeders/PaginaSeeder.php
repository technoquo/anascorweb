<?php

namespace Database\Seeders;

use App\Models\Pagina;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class PaginaSeeder extends Seeder
{
    public function run(): void
    {
        Storage::disk('public')->makeDirectory('paginas');

        $orgOrigen = public_path('org/estructura.png');
        $orgDestino = 'paginas/estructura.png';

        if (File::exists($orgOrigen)) {
            Storage::disk('public')->put($orgDestino, File::get($orgOrigen));
        }

        $paginas = [
            [
                'clave' => 'quienes-somos',
                'titulo' => '¿Qué es la ANASCOR?',
                'contenido' => '<p>La Asociación Nacional de Sordos de Costa Rica (ANASCOR) fue fundada el <strong>8 de junio de 1974</strong> con el objetivo de defender los derechos de las personas sordas y promover su plena inclusión en la sociedad costarricense.</p>

<p>ANASCOR representa a la comunidad sorda del país ante organismos nacionales e internacionales, y trabaja para garantizar el acceso a la educación, el trabajo, la cultura y todos los servicios públicos en Lengua de Señas Costarricense (LESCO).</p>

<h2>Razones de nuestra fundación</h2>
<ul>
<li>Defender los derechos humanos y civiles de las personas sordas</li>
<li>Promover el uso y reconocimiento oficial de la LESCO</li>
<li>Facilitar el acceso a la educación de calidad para niños y jóvenes sordos</li>
<li>Fomentar la inclusión laboral en igualdad de condiciones</li>
<li>Crear espacios de participación ciudadana para la comunidad sorda</li>
<li>Establecer vínculos con organizaciones de sordos a nivel internacional</li>
<li>Promover la identidad y cultura sorda costarricense</li>
<li>Combatir la discriminación y el audismo en todas sus formas</li>
</ul>',
                'imagen' => null,
                'alt' => '',
            ],
            [
                'clave' => 'mision',
                'titulo' => 'Misión',
                'contenido' => '<p>Representar, defender y promover los derechos de las personas sordas de Costa Rica, fomentando su inclusión plena en todos los ámbitos de la sociedad mediante la Lengua de Señas Costarricense (LESCO), el acceso a la educación, el trabajo y los servicios públicos, en un marco de igualdad, dignidad y respeto.</p>',
                'imagen' => null,
                'alt' => '',
            ],
            [
                'clave' => 'vision',
                'titulo' => 'Visión',
                'contenido' => '<p>Ser la organización líder en la defensa de los derechos de las personas sordas en Costa Rica, reconocida nacional e internacionalmente por su compromiso con la inclusión, la diversidad lingüística y el desarrollo integral de la comunidad sorda costarricense.</p>',
                'imagen' => null,
                'alt' => '',
            ],
            [
                'clave' => 'estructura',
                'titulo' => 'Estructura de Administración de ANASCOR',
                'contenido' => '<p>La estructura organizativa de ANASCOR está conformada por una Junta Directiva electa democráticamente por la Asamblea General de asociados, un Fiscal y comités de trabajo especializados en diferentes áreas de interés para la comunidad sorda.</p>',
                'imagen' => File::exists($orgOrigen) ? $orgDestino : null,
                'alt' => 'Organigrama de la estructura administrativa de ANASCOR',
            ],
            [
                'clave' => 'que-es-lesco',
                'titulo' => '¿Qué es la LESCO?',
                'contenido' => '<p>La <strong>Lengua de Señas Costarricense (LESCO)</strong> es la lengua natural y propia de la comunidad sorda de Costa Rica. Es una lengua visual-gestual completa, con gramática, sintaxis y vocabulario propios, diferente a cualquier otra lengua de señas del mundo.</p>

<p>La LESCO no es una versión manual del español: tiene su propia estructura lingüística, utiliza el espacio frente al cuerpo como campo de comunicación, y se expresa mediante movimientos de las manos, los brazos, la cara y el cuerpo.</p>

<p>Es el medio principal de comunicación de miles de personas sordas en Costa Rica y un patrimonio cultural invaluable que ANASCOR trabaja diariamente por preservar, difundir y proteger.</p>',
                'imagen' => null,
                'alt' => '',
            ],
        ];

        foreach ($paginas as $pagina) {
            Pagina::updateOrCreate(['clave' => $pagina['clave']], $pagina);
        }
    }
}
