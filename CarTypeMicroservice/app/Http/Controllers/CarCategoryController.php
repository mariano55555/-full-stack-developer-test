<?php

namespace App\Http\Controllers;

use App\CarCategory;
use Illuminate\Http\Request;

class CarCategoryController extends Controller
{
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
        return $categories;
    }

    /**
     * Creates an instance of CarCategory
     * @return Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        # code...
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
