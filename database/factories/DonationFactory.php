<?php

use App\Donation;
use Faker\Generator as Faker;

$factory->define(Donation::class, function (Faker $faker) {
    return [
        'donor_id' => function () {
            return factory(App\Donor::class)->create()->id;
        },
        'appointment_date' => $faker->dateTimeBetween('now', '+6 months'),
        'status' => \App\DonationStatus::REQUESTED,
        'status_date' => \Carbon\Carbon::now()
    ];
});
