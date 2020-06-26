<?php

namespace App\Services;

use App\Traits\ConsumesExternalService;

class ParkingService
{
    use ConsumesExternalService;

    /**
     * The base uri to be used to consume the cars service
     * @var string
     */
    public $baseUri;


    /**
     * The secret to be used to consume the cars service
     * @var string
     */
    public $secret;

    public function __construct()
    {
        $this->baseUri = config('services.parking.base_uri');
        $this->secret = config('services.parking.secret');
    }

    /**
     * Get the full list of cars from the cars service
     * @return string
     */
    public function obtainParkingRecords()
    {
        return $this->performRequest('GET', '/parking');
    }

    /**
     * Create an instance of car using the cars service
     * @return string
     */
    public function createParking($data)
    {
        return $this->performRequest('POST', '/parking', $data);
    }

    public function getParkingMonth($month, $year)
    {
        return $this->performRequest('GET', "/getparking/{$month}/{$year}");
    }


}
