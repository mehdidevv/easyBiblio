<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Book;
use Faker\Generator as Faker;

$factory->define(Book::class, function (Faker $faker) {
    return [
        'author_id' => $faker->numberBetween(1, 15),
        'category_id' => $faker->numberBetween(1, 8),
        'title' => $faker->sentence(2, true),
        'isbn' => $faker->sentence(4, true),
        'nb_pages' => $faker->numberBetween(20, 300),
        'year' => $faker->date('Y'),
        'description' => $faker->paragraph(3, true),
        'availability' => true,
        'cover' => 'default.png'

    ];
});
