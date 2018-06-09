<?php

use Faker\Generator as Faker;

$factory->define(App\BloodContainer::class, function (Faker $faker) {
    return [
        "type" => $faker->randomElement(['Red blood cell', 'plasma', 'thrombocytes']),
        "store_date" => $faker->dateTimeBetween('-1 month'),
        "donation_id" => function () {
            return factory(App\Donation::class)->create()->id;
        },
    ];
});
