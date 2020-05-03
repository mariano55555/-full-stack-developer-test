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
        return $this->successResponse($this->carService->obtainParking());
    }


    public function store(Request $request)
    {
        return $this->successResponse($this->carService->storeParking($request->all()), Response::HTTP_CREATED);
    }

    public function show(Request $request)
    {
        return $this->successResponse($this->carService->showParking($request->all()), Response::HTTP_CREATED);
    }



}
