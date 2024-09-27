<?php

namespace Database\Seeders;

use App\Models\State;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Deyber',
            'last_name' => 'Manrique',
            'email' => 'dmanriquea@unasam.edu.pe',
        ]);

        State::create(['name' => 'Subiendo archivos']);
        State::create(['name' => 'Pendiente de revisión']);
        State::create(['name' => 'Aceptado en la Dirección del Instituto de Investigación']);
        State::create(['name' => 'Denegado en la Dirección del Instituto de Investigación']);
        State::create(['name' => 'Aprobado en el Consejo Universitario']);
        State::create(['name' => 'Denegado en el Consejo Universitario']);
    }
}
