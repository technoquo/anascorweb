<?php

namespace Database\Seeders;

use App\Models\Canton;
use App\Models\Provincia;
use Illuminate\Database\Seeder;

class ProvinciaSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            'San José' => [
                'San José', 'Escazú', 'Desamparados', 'Puriscal', 'Tarrazú',
                'Aserrí', 'Mora', 'Goicoechea', 'Santa Ana', 'Alajuelita',
                'Vásquez de Coronado', 'Acosta', 'Tibás', 'Moravia', 'Montes de Oca',
                'Turrubares', 'Dota', 'Curridabat', 'Pérez Zeledón', 'León Cortés Castro',
            ],
            'Alajuela' => [
                'Alajuela', 'San Ramón', 'Grecia', 'San Mateo', 'Atenas',
                'Naranjo', 'Palmares', 'Poás', 'Orotina', 'San Carlos',
                'Alfaro Ruiz', 'Valverde Vega', 'Upala', 'Los Chiles', 'Guatuso',
                'Río Cuarto',
            ],
            'Cartago' => [
                'Cartago', 'Paraíso', 'La Unión', 'Jiménez', 'Turrialba',
                'Alvarado', 'Oreamuno', 'El Guarco',
            ],
            'Heredia' => [
                'Heredia', 'Barva', 'Santo Domingo', 'Santa Bárbara', 'San Rafael',
                'San Isidro', 'Belén', 'Flores', 'San Pablo', 'Sarapiquí',
            ],
            'Guanacaste' => [
                'Liberia', 'Nicoya', 'Santa Cruz', 'Bagaces', 'Carrillo',
                'Cañas', 'Abangares', 'Tilarán', 'Nandayure', 'La Cruz', 'Hojancha',
            ],
            'Puntarenas' => [
                'Puntarenas', 'Esparza', 'Buenos Aires', 'Montes de Oro', 'Osa',
                'Quepos', 'Golfito', 'Coto Brus', 'Parrita', 'Corredores',
                'Garabito', 'Colorado', 'Monteverde',
            ],
            'Limón' => [
                'Limón', 'Pococí', 'Siquirres', 'Talamanca', 'Matina', 'Guácimo',
            ],
        ];

        foreach ($data as $nombreProvincia => $cantones) {
            $provincia = Provincia::create(['nombre' => $nombreProvincia]);

            foreach ($cantones as $nombreCanton) {
                Canton::create([
                    'provincia_id' => $provincia->id,
                    'nombre' => $nombreCanton,
                ]);
            }
        }
    }
}
