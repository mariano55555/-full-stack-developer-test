<?php

namespace App\Http\Controllers;

use App\Traits\ApiResponser;
use Illuminate\Http\Request;

class CategoryController extends Controller
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
    public function show($category = null)
    {
        # code...
    }
    public function update(Request $request, $category = null)
    {
        # code...
    }
    public function destroy($category = null)
    {
        # code...
    }
}
