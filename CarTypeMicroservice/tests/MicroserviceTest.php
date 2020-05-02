<?php

use Faker\Factory;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class MicroserviceTest extends TestCase
{
    /**
     * A basic service test.
     *
     * @return void
     */
    public function testService()
    {
        $responseGET = $this->call('GET', '/');
        $this->assertEquals(200, $responseGET->status());
    }

    /**
     * testCanGetCategories
     *
     * @return void
     */
    public function testCanGetCategories()
    {
        $responseGET = $this->json('GET', '/categories');
        $responseGET->seeJsonStructure([
            'data' => [
                '*' => [
                    "_id", 'name', 'price_per_minute', 'isRegisterable', 'isBillable', 'monthlyCharge'
                ]
            ]
        ])
        ->assertResponseStatus(200);
    }


    /**
     * Get categories to be register in the application
     *
     * @return void
     */
    public function testCanGetRegisterableCategories()
    {
        $responseGET = $this->json('GET', '/categories/getregisterable');
        $responseGET->seeJsonStructure([
            'data' => [
                '*' => [
                    "_id", 'name', 'price_per_minute', 'isRegisterable', 'isBillable', 'monthlyCharge'
                ]
            ]
        ])
        ->assertResponseStatus(200);
    }

    /**
     * testCanGetCategories
     *
     * @return void
     */
    public function testCanCreateCategory()
    {
        $faker = Factory::create();

        $responseGET = $this->json('POST', '/categories',[
            'name'             => $name           = $faker->name,
            'price_per_minute' => $price          = rand(0, 10) / 10,
            'isRegisterable'   => $isRegisterable = true,
            'isBillable'       => $isBillable     = false,
            'monthlyCharge'    => $monthlyCharge  = true,
        ]);
        $responseGET->seeJsonStructure([
            'data' => [
                "_id", 'name', 'price_per_minute', 'isRegisterable', 'isBillable', 'monthlyCharge'
            ]
        ])
        ->assertResponseStatus(Response::HTTP_CREATED);

        $this->seeInDatabase('car_categories', [
            'name'             => $name,
            'price_per_minute' => $price,
            'isRegisterable'   => $isRegisterable,
            'isBillable'       => $isBillable,
            'monthlyCharge'    => $monthlyCharge,
        ]);
    }
}
