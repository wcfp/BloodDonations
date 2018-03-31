<?php

use Faker\Generator as Faker;

$factory->define(App\Address::class, function (Faker $faker) {
    return [
        'country' => $faker->country,
        'city' => $faker->city,
        'street' => $faker->streetName,
        'number' => $faker->buildingNumber
    ];
});
