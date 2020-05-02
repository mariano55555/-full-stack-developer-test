<?php

namespace App\Services;

use App\Traits\ConsumesExternalService;

class CarService
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
        $this->baseUri = config('services.cars.base_uri');
        $this->secret = config('services.cars.secret');
    }

    /**
     * Get the full list of cars from the cars service
     * @return string
     */
    public function obtainCars()
    {
        return $this->performRequest('GET', '/cars');
    }

    /**
     * Create an instance of car using the cars service
     * @return string
     */
    public function createCar($data)
    {
        return $this->performRequest('POST', '/cars', $data);
    }

    /**
     * Get a single car from the cars service
     * @return string
     */
    public function obtainCar($car)
    {
        return $this->performRequest('GET', "/car/{$car}");
    }

    /**
     * Edit a single car from the cars service
     * @return string
     */
    public function editCar($data, $car)
    {
        return $this->performRequest('PUT', "/cars/{$car}", $data);
    }

    /**
     * Remove a single car from the cars service
     * @return string
     */
    public function deleteCar($car)
    {
        return $this->performRequest('DELETE', "/cars/{$car}");
    }
}
