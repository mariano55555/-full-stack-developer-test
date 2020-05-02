<?php

namespace App\Http\Controllers;

use App\Car;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CarController extends Controller
{

    use ApiResponser;


    public function index()
    {
        $cars = Car::all();
        return $this->successResponse($cars);
    }


    public function store(Request $request)
    {
        $rules = [
            'license_plate' => 'required|max:255|unique:cars,license_plate',
            'brand'         => 'required|max:150',
            'color'         => 'required|max:150',
            'year'          => 'required|numeric',
            'category'      => 'required|max:255',
        ];

        $this->validate($request, $rules);

        $car = Car::create($request->all());

        return $this->successResponse($car, Response::HTTP_CREATED);
    }

    public function show($car)
    {
        $car = Car::findOrFail($car);
        return $this->successResponse($car);
    }


    public function update(Request $request, $car)
    {

    }

    public function destroy($car)
    {

    }
}
