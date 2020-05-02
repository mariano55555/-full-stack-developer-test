<?php

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
}
