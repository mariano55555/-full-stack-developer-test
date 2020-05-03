<?php

namespace App\Http\Controllers;

use App\Services\CarService;
use App\Services\CategoryService;
use App\Services\ParkingService;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ParkingController extends Controller
{

    use ApiResponser;


    public $carService;
    public $parkingService;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(CarService $carService, ParkingService $parkingService)
    {
        $this->carService = $carService;
        $this->parkingService = $parkingService;
    }

    public function index()
    {
        return $this->successResponse($this->parkingService->obtainParkingRecords());
    }


    public function store(Request $request)
    {
        return $this->successResponse($this->parkingService->createParking($request->all()), Response::HTTP_CREATED);
    }

    public function show($month = null, $year = null)
    {
        $month = isset($month) ? $month : date("n");
        $year  = isset($year) ? $year : date("Y");


        $data   = $this->parkingService->getParkingMonth($month, $year);
        $plates = json_decode($data, true);


        $data   = $this->carService->getParkingPrice($plates);
        return $this->successResponse($data);
    }



}
