<?php

use App\Car;
use Faker\Factory;
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

    public function createRecord()
    {
        $brands = ["Toyota", "Nissan", "Honda", "Suzuki", "Mitsubishi", "BMW"];
        $colors = ["Black", "Blue", "Red", "Brown", "Light Blue", "Yellow"];
        $faker  = Factory::create();
        $car    = Car::create([
            'license_plate' => $faker->text(10),
            'color'         => $colors[rand(0, 5)],
            'brand'         => $brands[rand(0, 5)],
            'year'          => rand(date("Y") - 10, date("Y")),
            'category'      => $faker->text(10),
        ]);

        return $car;
    }

    public function getKey()
    {
        $validSecrets = explode(',', env('ACCEPTED_SECRETS'));
        return ($validSecrets[0]) ? $validSecrets[0] : '';
    }
}
