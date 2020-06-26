<?php

namespace App\Http\Controllers;

use App\Car;
use App\CarCategory;
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
        $rules = [
            'license_plate' => 'max:255|unique:cars,license_plate,' . $car,
            'brand'         => 'max:150',
            'color'         => 'max:150',
            'year'          => 'numeric',
            'category'      => 'max:255',
        ];


        $this->validate($request, $rules);

        $car = Car::findOrFail($car);

        $car->fill($request->all());

        if ($car->isClean()) {
            return $this->errorResponse('You need to change at least one field', Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $car->save();

        return $this->successResponse($car);
    }

    public function destroy($car)
    {
        $car = Car::findOrFail($car);

        $car->delete();

        return $this->successResponse($car);
    }


    public function getParkingPrice(Request $request)
    {
        if(!$request->has("data")){
            return $this->successResponse(array());
        }

        $data = $request->all();
        $data = $data["data"];

        $cars = Car::with("car_category:name,price_per_minute,isBillable,monthlyCharge")
                    ->whereIn("license_plate", array_keys($data))
                    ->get();
        $aux = [];
        foreach ($cars as $car) {
            array_push($aux, $car->license_plate);
            $car->total_month = $data[$car->license_plate] * $car->car_category->price_per_minute;
        }


         $noresidentes_aux = [];
         $noresidentes = array_values(array_diff(array_keys($data),$aux));
         if(!empty($noresidentes)){
             $no_residente = CarCategory::where("name", "No Residente")->first();
             foreach ($noresidentes as $noresidente) {
                    array_push($noresidentes_aux, [
                        'license_plate' => $noresidente,
                        'total_month'   => $no_residente->price_per_minute * $data[$noresidente],
                        'car_category'  => $no_residente
                    ]);
             }
             $cars = $cars->concat($noresidentes_aux);
             $cars->all();
         }



        return $this->successResponse($cars);
    }
}
