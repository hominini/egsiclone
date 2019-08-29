<?php

use Illuminate\Database\Seeder;
use App\Institution;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Faker\Factory as Faker;

class InstitutionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        Storage::fake('images_institution');
        $icon = UploadedFile::fake()->image('icon.jpg');
        $institution_picture = UploadedFile::fake()->image('instituto_logo.jpg');

        // seeder de instituciones
        Institution::create([
            'name' => 'Instituto Nacional de Estadítica y Censos',
            'acronym' => 'INEC',
            'description' => $faker->paragraph(),
            'institution_picture' => $institution_picture,
            'website' => 'https://www.ecuadorencifras.gob.ec/institucional/home/',
            'icon' => $icon,
            'clasification' => 'Ejecutiva',
            'sector' => 'Judicial',
        ]);

        Institution::create([
            'name' => 'Ministerio de Educación',
            'acronym' => 'ME',
            'description' => $faker->paragraph(),
            'institution_picture' => $institution_picture,
            'website' => 'https://educacion.gob.ec/',
            'icon' => $icon,
            'clasification' => 'Ejecutiva',
            'sector' => 'Judicial',
        ]);

        Institution::create([
            'name' => 'Ministerio Nacional de Telecomunicaciones',
            'acronym' => 'MINTEL',
            'description' => $faker->paragraph(),
            'institution_picture' => $institution_picture,
            'website' => 'https://educacion.gob.ec/',
            'icon' => $icon,
            'clasification' => 'Ejecutiva',
            'sector' => 'Judicial',
        ]);

    }
}
