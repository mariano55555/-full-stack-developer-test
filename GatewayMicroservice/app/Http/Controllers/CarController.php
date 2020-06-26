<?php

namespace App\Http\Controllers;

use App\Services\CarService;
use App\Services\CategoryService;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CarController extends Controller
{

    use ApiResponser;


    public $carService;
    public $categoryService;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(CarService $carService, CategoryService $categoryService)
    {
        $this->carService = $carService;
        $this->categoryService = $categoryService;
    }

    public function index()
    {
        return $this->successResponse($this->carService->obtainCars());
    }


    public function store(Request $request)
    {
        $this->categoryService->obtainCategory($request->category);

        return $this->successResponse($this->carService->createCar($request->all()), Response::HTTP_CREATED);
    }


    public function show($car = null)
    {
        return $this->successResponse($this->carService->obtainCar($car));
    }

    public function update(Request $request, $car = null)
    {
        $this->categoryService->obtainCategory($request->category);
        return $this->successResponse($this->carService->editCar($request->all(), $car));
    }

    public function destroy($car = null)
    {
        return $this->successResponse($this->carService->deleteCar( $car));
    }

    public function getParkingPrice(Request $request)
    {
        return $this->successResponse($this->carService->getParkingPrice($request->all()));
    }
}
