<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;
use App\Fulfillment;

$factory->define(Fulfillment::class, function (Faker $faker) {
    return [
        'institution_id' => factory(App\Institution::class)->create()->id,
        'milestone_id' => factory(App\Milestone::class)->create()->id,
        'fulfillment_date' => $faker->date,
        'oficial_de_seguridad_id' => 1,
        'responsable_id' => 1,
    ];
});
