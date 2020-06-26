<?php

namespace App\Http\Controllers;

use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Services\CategoryService;

class CarCategoryController extends Controller
{

    use ApiResponser;

    public $categoryService;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function index()
    {
        return $this->successResponse($this->categoryService->obtainCategories());
    }


    public function store(Request $request)
    {
        return $this->successResponse($this->categoryService->createCategory($request->all()), Response::HTTP_CREATED);
    }


    public function show($category = null)
    {
        return $this->successResponse($this->categoryService->obtainCategory($category));
    }

    public function update(Request $request, $category = null)
    {
        return $this->successResponse($this->categoryService->editCategory($request->all(), $category));
    }

    public function destroy($category = null)
    {
        return $this->successResponse($this->categoryService->deleteCategory($category));
    }
}
