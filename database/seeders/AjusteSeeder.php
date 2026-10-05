<?php

namespace Database\Seeders;

use App\Models\Ajuste;
use Illuminate\Database\Seeder;

class AjusteSeeder extends Seeder
{
    public function run(): void
    {
        $ajustes = [
            'direccion' => 'Provincia San José, Cantón Central, Barrio Escalante; 300 metros norte de la Iglesia Santa Teresita, 25 este a mano derecha, casa n.º 2350.',
            'correo' => 'anascor74@gmail.com',
            'telefono' => '',
            'facebook' => 'https://www.facebook.com/ANASCORCR',
            'instagram' => 'https://www.instagram.com/anascorcr',
            'tiktok' => 'https://www.tiktok.com/@anascorcr',
            'mapa_embed_url' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3930.1!2d-84.0621!3d9.9350!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zOcKwNTYnMDYuMCJOIDg0wrAwMyc0My42Ilc!5e0!3m2!1ses!2scr!4v1',
            'correo_tesoreria' => 'tesoanascor@gmail.com',
            'dias_gracia' => '3',
            'monto_mensual' => '5000',
            'monto_trimestral' => '15000',
            'monto_anual' => '60000',
            'personas_sordas' => '',
            'fuente_personas_sordas' => '',
        ];

        foreach ($ajustes as $clave => $valor) {
            Ajuste::updateOrCreate(['clave' => $clave], ['valor' => $valor]);
        }
    }
}
