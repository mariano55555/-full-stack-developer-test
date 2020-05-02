<?php

namespace App\Http\Controllers;

use App\CarCategory;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CarCategoryController extends Controller
{

    use ApiResponser;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Retrieve and show all Car Categories
     * @return Illuminate\Http\Response
     */
    public function index()
    {
        $categories = CarCategory::all();
        return $this->successResponse($categories);
    }

    /**
     * Creates an instance of CarCategory
     * @return Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'name'             => 'required|max:255',
            'price_per_minute' => 'required|numeric',
            'isRegisterable'   => 'required|',
            'isBillable'       => 'required|',
            'monthlyCharge'    => 'required|',
        ];

        $this->validate($request, $rules);

        $category = CarCategory::create($request->all());

        return $this->successResponse($category, Response::HTTP_CREATED);
    }


    /**
     * Update an instance of CarCategory
     * @return Illuminate\Http\Response
     */
    public function update(Request $request, $car = null)
    {
        # code...
    }

    /**
     * Removes an instance of CarCategory
     * @return Illuminate\Http\Response
     */
    public function destroy($car = null)
    {
        # code...
    }
}
