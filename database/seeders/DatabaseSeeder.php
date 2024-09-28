<?php

namespace Database\Seeders;

use App\Models\Faculty;
use App\Models\School;
use App\Models\Setting;
use App\Models\State;
use App\Models\Student;
use App\Models\User;
use App\Models\Vicerrector;
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
            'is_admin' => true,
        ]);

        State::create(['name' => 'Inicio de la postulación']);
        State::create(['name' => 'Subida de requerimientos']);
        State::create(['name' => 'Evaluado']);
        State::create(['name' => 'Observado']);
        State::create(['name' => 'Aprobado']);
        State::create(['name' => 'Denegado']);

        Faculty::create(['name' => 'Ciencias']);
        School::create(['name' => 'Sistemas', 'faculty_id' => 1]);
        Vicerrector::create(['name' => 'Teresa', 'last_name' => 'Vicerrectora']);

        User::factory()->create([
            'name' => 'Antonio',
            'last_name' => 'Acuña',
            'email' => 'antonio@unasam.edu.pe',
        ]);

        Student::create([
            'dni' => '08451235',
            'phone' => '954123456',
            'school_id' => '1',
            'user_id' => '2',
            'condition' => '1',
        ]);

        Setting::create(['key' => 'limit_postulations', 'value' => '1']);
        Setting::create(['key' => 'subsidy_link', 'value' => 'https://investigacion.unasam.edu.pe/subvenciones']);
        Setting::create(['key' => 'regulation_link', 'value' => 'https://investigacion.unasam.edu.pe/noticia/reglamento-subvenciones-economicas-a-favor-de-graduados-y-estudiantes-de-pregrado-para-el-desarrollo-de-actividades-academicas-y-de-investigacion-formativa-unasam-2024']);
        Setting::create(['key' => 'cover_image', 'value' => 'https://www.unasam.edu.pe/web/noticiaunasam/noticia-11-04-2024-09-12-51.jpg']);
        Setting::create(['key' => 'unasam_link', 'value' => 'https://unasam.edu.pe/']);
        Setting::create(['key' => 'vicerrectorate_link', 'value' => 'https://investigacion.unasam.edu.pe/']);
    }
}
