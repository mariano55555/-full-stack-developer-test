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
            //'Authorization' => $this->getKey()
        ]);
        $responseGET->assertResponseStatus(200);
    }


}
