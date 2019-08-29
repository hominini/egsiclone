<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Milestone;
use Faker\Generator as Faker;

$factory->define(Milestone::class, function (Faker $faker) {
    return [
        'milestone_number' => $faker->word,
        'description' => $faker->sentence,
        'is_a_priority' => $faker->boolean,
    ];
});
