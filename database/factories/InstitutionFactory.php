<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Institution;
use Faker\Generator as Faker;

$factory->define(Institution::class, function (Faker $faker) {
    return [
        'name' => 'Ministerio de Salud Pública',
        'acronym' => 'MSP',
        'description' => $faker->paragraph(),
        'institution_picture' => 'picture_url',
        'website' => $faker->url,
        'icon' => 'icon_url',
        'clasification' => 'Ejecutiva',
        'sector' => 'Judicial',
    ];
});
