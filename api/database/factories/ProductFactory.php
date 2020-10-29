<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Entities\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence(2),
        'category' => $faker->sentence(1),
        'price' => $faker->randomNumber(2),
        'description' => $faker->text(300),
        'status' => Product::STATUS['approved'],
    ];
});
