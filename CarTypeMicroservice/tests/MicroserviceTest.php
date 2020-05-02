<?php

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


    public function testCanGetCategories()
    {
        $responseGET = $this->call('GET', '/categories');
        // $responseGET
        // ->seeJsonStructure([
        //     'data' => [
        //         '_id', 'name', 'email', 'created_at', 'updated_at'
        //     ]
        // ]);
        $this->assertEquals(200, $responseGET->status());
    }
}
