<?php

use App\Car;
use Faker\Factory;
use App\CarCategory;
use Laravel\Lumen\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    /**
     * Creates the application.
     *
     * @return \Laravel\Lumen\Application
     */
    public function createApplication()
    {
        return require __DIR__.'/../bootstrap/app.php';
    }

    public function createCarRecord()
    {
        $faker  = Factory::create();

        $brands = ["Toyota", "Nissan", "Honda", "Suzuki", "Mitsubishi", "BMW"];
        $colors = ["Black", "Blue", "Red", "Brown", "Light Blue", "Yellow"];

        $car    = Car::create([
            'license_plate' => $faker->unique()->text(45),
            'color'         => $colors[rand(0, 5)],
            'brand'         => $brands[rand(0, 5)],
            'year'          => rand(date("Y") - 10, date("Y")),
            'category'      => $faker->text(10),
        ]);

        return $car;
    }

    public function createCategoryRecord()
    {
        $faker = Factory::create();
        $category = CarCategory::create([
            'name'             => $faker->unique()->name,
            'price_per_minute' => rand(0, 10) / 10,
            'isRegisterable'   => (bool)random_int(0, 1),
            'isBillable'       => (bool)random_int(0, 1),
            'monthlyCharge'    => (bool)random_int(0, 1),
        ]);

        return $category;
    }

    public function getKey()
    {
        $validSecrets = explode(',', env('ACCEPTED_SECRETS'));
        return ($validSecrets[0]) ? $validSecrets[0] : '';
    }
}
