<?php

use Faker\Generator as Faker;
use App\BloodRequest;

$factory->define(BloodRequest::class, function (Faker $faker) {
    return [
        'urgency_level' => 'normal',
        'doctor_id' => function () {
            return factory(App\User::class)->create(['role' => \App\UserType::DOCTOR])->id;
        },
        'address_id' => function () {
        return factory(App\Address::class)->create()->id;
    },
        'status' => \App\BloodRequestStatus::REQUESTED,
        'status_date' => \Carbon\Carbon::now()
    ];
});
