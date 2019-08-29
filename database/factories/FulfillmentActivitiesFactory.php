<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\FulfillmentActivity;
use Faker\Generator as Faker;

$factory->define(FulfillmentActivity::class, function (Faker $faker) {
    return [
        'fulfillment_id' => factory(App\Fulfillment::class)->create()->id,
        'activity_summary' => $faker->paragraph,
        'evidence_file_path' => 'foo/bar',
    ];
});
