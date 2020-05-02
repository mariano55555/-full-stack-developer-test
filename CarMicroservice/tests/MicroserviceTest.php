<?php

use App\CarCategory;
use Faker\Factory;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class MicroserviceTest extends TestCase
{

    #use DatabaseMigrations;

    public function __list()
    {
        $brands = ["Toyota", "Nissan", "Honda", "Suzuki", "Mitsubishi", "BMW"];
        $colors = ["Black", "Blue", "Red", "Brown", "Light Blue", "Yellow"];
        return [$brands, $colors];
    }


    /**
     * A basic service test.
     *
     * @return void
     */
    public function testService()
    {
        $responseGET = $this->json('GET', '/', [], [
            'Authorization' => $this->getKey()
        ]);
        $responseGET->assertResponseStatus(200);
    }


    public function testCanGetCars()
    {
        $responseGET = $this->json('GET', '/cars', [], [
            'Authorization' => $this->getKey()
        ]);
        $responseGET->seeJsonStructure([
            'data' => [
                '*' => [
                    "_id", 'license_plate', 'brand', 'color', 'year', 'category', 'updated_at', 'created_at'
                ]
            ]
        ])
        ->assertResponseStatus(200);
    }

    public function testCanCreateCar()
    {
        $faker = Factory::create();

        [$brands, $colors] = $this->__list();

        $responseGET = $this->json('POST', '/cars',[
            'license_plate' => $license_plate = $faker->text(10),
            'color'         => $color         = $colors[rand(0, 5)],
            'brand'         => $brand         = $brands[rand(0, 5)],
            'year'          => $year          = rand(date("Y") - 10, date("Y")),
            'category'      => $category      = $faker->text(10),
        ],[
            'Authorization' => $this->getKey()
        ]);


        $responseGET->seeJsonStructure([
            'data' => [
                "_id", 'license_plate', 'brand', 'color', 'year', 'category', 'updated_at', 'created_at'
            ]
        ])
        ->assertResponseStatus(Response::HTTP_CREATED);

        $this->seeInDatabase('cars', [
            'license_plate' => $license_plate,
            'color'         => $color,
            'brand'         => $brand,
            'year'          => $year,
            'category'      => $category,
        ]);
    }

    public function testCanGetOneCar()
    {
        $car = $this->createRecord();
        $responseGET = $this->json('GET', "/car/{$car->_id}", [],[
            'Authorization' => $this->getKey()
        ]);
        $responseGET->seeJsonStructure([
            'data' => [
                "_id", 'license_plate', 'brand', 'color', 'year', 'category', 'updated_at', 'created_at'
            ]
        ])
        ->assertResponseStatus(200);
    }

    public function testCanUpdateCar()
    {

        $faker             = Factory::create();
        $car               = $this->createRecord();
        [$brands, $colors] = $this->__list();

        $responseGET = $this->json('PUT', "/cars/{$car->_id}",[
            'license_plate' => $license_plate = $faker->text(10),
            'color'         => $color         = $colors[rand(0, 5)],
            'brand'         => $brand         = $brands[rand(0, 5)],
            'year'          => $year          = rand(date("Y") - 10, date("Y")),
            'category'      => $category      = $faker->text(10),
        ],[
            'Authorization' => $this->getKey()
        ]);
        $responseGET->seeJsonStructure([
            'data' => [
                "_id", 'license_plate', 'brand', 'color', 'year', 'category', 'updated_at', 'created_at'
            ]
        ])
        ->assertResponseStatus(200);

        $this->seeInDatabase('cars', [
            'license_plate' => $license_plate,
            'color'         => $color,
            'brand'         => $brand,
            'year'          => $year,
            'category'      => $category
        ]);
    }

    public function testCanDeleteCar()
    {
        $car = $this->createRecord();
        $responseDELETE = $this->json('DELETE', "/cars/{$car->_id}", [], [
            'Authorization' => $this->getKey()
        ]);
        $responseDELETE->seeJsonStructure([
            'data' => [
                "_id", 'license_plate', 'brand', 'color', 'year', 'category', 'updated_at', 'created_at'
            ]
        ])
        ->assertResponseStatus(200);
    }

}
