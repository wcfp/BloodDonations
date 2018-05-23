<?php

use Faker\Generator as Faker;

$factory->define(App\Donor::class, function (Faker $faker) {
    return [
        'user_id' => function () {
            return factory(App\User::class)->create(['role' => 'DONOR'])->id;
        },
        'current_address_id' => function () {
            return factory(App\Address::class)->create()->id;
        },
        'residence_address_id' => function () {
            return factory(App\Address::class)->create()->id;
        },
        'blood_type' => $faker->randomElement(['0', 'A', 'B', 'AB']),
        'rh' => $faker->randomElement(['+', '-']),
        'weight' => $faker->numberBetween(50, 100),
        'birth_date' => $faker->dateTimeBetween(),
        'phone_number' => $faker->phoneNumber,
    ];
});
