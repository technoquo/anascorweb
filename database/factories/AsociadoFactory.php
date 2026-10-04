<?php

namespace Database\Factories;

use App\Models\Asociado;
use App\Models\Canton;
use App\Models\Provincia;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends Factory<Asociado>
 */
class AsociadoFactory extends Factory
{
    public function definition(): array
    {
        $provincia = Provincia::inRandomOrder()->first()
            ?? Provincia::factory()->create(['nombre' => 'San José']);

        $canton = Canton::where('provincia_id', $provincia->id)->inRandomOrder()->first()
            ?? Canton::factory()->create(['provincia_id' => $provincia->id, 'nombre' => 'Central']);

        return [
            'nombre_completo' => $this->faker->name(),
            'foto' => null,
            'cedula' => $this->faker->unique()->numerify('#########'),
            'fecha_nacimiento' => $this->faker->dateTimeBetween('-60 years', '-18 years')->format('Y-m-d'),
            'provincia_id' => $provincia->id,
            'canton_id' => $canton->id,
            'ciudad' => $this->faker->city(),
            'direccion' => $this->faker->address(),
            'correo' => $this->faker->unique()->safeEmail(),
            'telefono' => $this->faker->numerify('########'),
            'password' => Hash::make('password'),
            'debe_cambiar_password' => false,
            'fecha_afiliacion' => now()->subYear()->format('Y-m-d'),
            'fecha_inicio' => now()->subYear()->format('Y-m-d'),
            'fecha_fin' => null,
            'plan_cuota' => $this->faker->randomElement(['mensual', 'trimestral', 'anual']),
            'pagado_hasta' => now()->addMonth()->format('Y-m-d'),
            'moroso' => false,
            'activo' => true,
        ];
    }

    public function moroso(): static
    {
        return $this->state(fn () => [
            'moroso' => true,
            'pagado_hasta' => now()->subMonth()->format('Y-m-d'),
        ]);
    }

    public function debecambiar(): static
    {
        return $this->state(fn () => ['debe_cambiar_password' => true]);
    }

    public function inactivo(): static
    {
        return $this->state(fn () => ['activo' => false]);
    }
}
