<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'admin@anascor.org'],
            ['name' => 'Admin ANASCOR', 'password' => bcrypt('Admin1234!')]
        );

        $this->call([
            ProvinciaSeeder::class,
            AjusteSeeder::class,
            ValorSeeder::class,
            LescoSeccionSeeder::class,
            PaginaSeeder::class,
            SlideSeeder::class,
            MiembroJuntaSeeder::class,
            ExpresidenteSeeder::class,
            AcademiaSeeder::class,
            ConvenioSeeder::class,
            HitoHistoriaSeeder::class,
            ComiteSeeder::class,
            NoticiasSeeder::class,
            EventoSeeder::class,
            AlbumSeeder::class,
            RoleSeeder::class,
        ]);
    }
}
