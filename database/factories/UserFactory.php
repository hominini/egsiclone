<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\User;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => 'password', // password
        'remember_token' => Str::random(10),
        'nombres' => $faker->firstName,
        'apellidos' => $faker->lastName,
        'cedula' => '17237' . $faker->numberBetween(10000, 99999),
        'cargo' => $faker->jobTitle,
        'area' => $faker->sentence,
        'institucion_id' => $faker->numberBetween(1, 9999),
    ];
});
