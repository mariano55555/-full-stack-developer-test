<?php

namespace App\Http\Controllers;

use App\Traits\ApiResponser;
use Illuminate\Http\Request;

class CarController extends Controller
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

    public function index()
    {
        # code...
    }
    public function store(Request $request)
    {
        # code...
    }
    public function show($car = null)
    {
        # code...
    }
    public function update(Request $request, $car = null)
    {
        # code...
    }
    public function destroy($car = null)
    {
        # code...
    }
}
