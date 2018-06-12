<?php

use Faker\Generator as Faker;
use App\BloodRequest;

$factory->define(BloodRequest::class, function (Faker $faker) {
    return [
        'urgency_level' => $faker->randomElement(['normal', 'high', 'critical']),
        'doctor_id' => function () {
            return factory(App\User::class)->create(['role' => \App\UserType::DOCTOR])->id;
        },
        'address_id' => function () {
        return factory(App\Address::class)->create()->id;
        },
        'blood_type' => $faker->randomElement(['0', 'A', 'B', 'AB']),
        'rh'=>$faker->randomElement(['+', '-']),
        'status' => \App\BloodRequestStatus::REQUESTED,
        'status_date' => \Carbon\Carbon::now(),
        'thrombocyte_quantity'=> $faker->numberBetween(1, 7),
        'plasma_quantity'=> $faker->numberBetween(1, 7),
        'red_blood_cells_quantity'=> $faker->numberBetween(1, 7),
    ];
});
