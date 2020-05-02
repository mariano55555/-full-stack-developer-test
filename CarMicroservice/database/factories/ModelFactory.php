<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Car;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(Car::class, function (Faker $faker) {

    $brands = ["Toyota", "Nissan", "Honda", "Suzuki", "Mitsubishi", "BMW"];
    $colors = ["Black", "Blue", "Red", "Brown", "Light Blue", "Yellow"];
    return [
        'license_plate' => $faker->text(10),
        'color'         => $colors[rand(0, 5)],
        'brand'         => $brands[rand(0, 5)],
        'year'          => rand(date("Y") - 10, date("Y")),
        'category'      => $faker->text(10),
    ];
});
