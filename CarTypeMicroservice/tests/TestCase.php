<?php

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

    public function createRecord()
    {
        $faker = Factory::create();
        $category = CarCategory::create([
            'name'             => $faker->name,
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
