<?php

namespace App\Http\Controllers;

use App\Car;
use App\Traits\ApiResponser;

class CarController extends Controller
{

    use ApiResponser;


    public function index()
    {
        $cars = Car::all();
        return $this->successResponse($cars);
    }
}
