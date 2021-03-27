<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Reservation;
use Faker\Generator as Faker;

$factory->define(Reservation::class, function (Faker $faker) {
    return [
        'user_id' => 1,
        'book_id' => $faker->numberBetween(1, 10),
        'return_date' => $faker->date(),
    ];
});
