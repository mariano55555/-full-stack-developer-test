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

    /**
     * testCanGetCategories
     *
     * @return void
     */
    public function testCanGetCategories()
    {
        $responseGET = $this->json('GET', '/categories', [], [
            'Authorization' => $this->getKey()
        ]);
        $responseGET->seeJsonStructure([
            'data' => [
                '*' => [
                    "_id", 'name', 'price_per_minute', 'isRegisterable', 'isBillable', 'monthlyCharge', 'updated_at', 'created_at'
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
        $responseGET = $this->json('GET', '/categories/getregisterable',[],[
            'Authorization' => $this->getKey()
        ]);
        $responseGET->seeJsonStructure([
            'data' => [
                '*' => [
                    "_id", 'name', 'price_per_minute', 'isRegisterable', 'isBillable', 'monthlyCharge', 'updated_at', 'created_at'
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
            'isRegisterable'   => $isRegisterable = (bool)random_int(0, 1),
            'isBillable'       => $isBillable     = (bool)random_int(0, 1),
            'monthlyCharge'    => $monthlyCharge  = (bool)random_int(0, 1),
        ],[
            'Authorization' => $this->getKey()
        ]);
        $responseGET->seeJsonStructure([
            'data' => [
                "_id", 'name', 'price_per_minute', 'isRegisterable', 'isBillable', 'monthlyCharge', 'updated_at', 'created_at'
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


     /**
     * Show one category
     *
     * @return void
     */
    public function testGetOneCategory()
    {

        $category    = $this->createRecord();
        $responseGET = $this->json('GET', "/category/{$category->_id}", [],[
            'Authorization' => $this->getKey()
        ]);
        $responseGET->seeJsonStructure([
            'data' => [
                    "_id", 'name', 'price_per_minute', 'isRegisterable', 'isBillable', 'monthlyCharge', 'updated_at', 'created_at'
            ]
        ])
        ->assertResponseStatus(200);

    }


    public function canUpdateCategory()
    {
        $faker    = Factory::create();
        $category = $this->createRecord();

        $responseGET = $this->json('PUT', "/categories/{$category->_id}",[
            'name'             => $name           = $faker->name,
            'price_per_minute' => $price          = rand(0, 10) / 10,
            'isRegisterable'   => $isRegisterable = (bool)random_int(0, 1),
            'isBillable'       => $isBillable     = (bool)random_int(0, 1),
            'monthlyCharge'    => $monthlyCharge  = (bool)random_int(0, 1),
        ],[
            'Authorization' => $this->getKey()
        ]);
        $responseGET->seeJsonStructure([
            'data' => [
                "_id", 'name', 'price_per_minute', 'isRegisterable', 'isBillable', 'monthlyCharge', 'updated_at', 'created_at'
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

    public function test404OnNotFound()
    {
        $responseGET = $this->json('GET', '/asdfasfa', [], [
            'Authorization' => $this->getKey()
        ]);
        $responseGET->assertResponseStatus(404);
    }

    public function testCanDelete()
    {
        $category = $this->createRecord();
        $responseDELETE = $this->json('DELETE', "/categories/{$category->_id}", [], [
            'Authorization' => $this->getKey()
        ]);
        $responseDELETE->seeJsonStructure([
            'data' => [
                    "_id", 'name', 'price_per_minute', 'isRegisterable', 'isBillable', 'monthlyCharge', 'deleted_at', 'updated_at', 'created_at'
            ]
        ])
        ->assertResponseStatus(200);
    }
}
