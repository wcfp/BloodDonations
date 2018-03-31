<?php

use Faker\Generator as Faker;

$factory->define(App\Donor::class, function (Faker $faker) {
    return [
        'user_id' => function () {
            return factory(App\User::class)->create(['role' => 'DONOR'])->id;
        },
        'current_address_id' => $faker->numberBetween(1, App\Address::count()),
        'residence_address_id' => $faker->numberBetween(1, App\Address::count()),
        'blood_type' => $faker->randomElement(['0', 'A', 'B', 'AB']),
        'rh' => $faker->randomElement(['+', '-'])
    ];
});
