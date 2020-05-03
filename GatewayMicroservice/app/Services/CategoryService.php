<?php

namespace App\Services;

use App\Traits\ConsumesExternalService;

class CategoryService
{
    use ConsumesExternalService;

    /**
     * The base uri to be used to consume the cars service
     * @var string
     */
    public $baseUri;

    /**
     * The secret to be used to consume the cars service
     * @var string
     */
    public $secret;

    public function __construct()
    {
        $this->baseUri = config('services.categories.base_uri');
        $this->secret = config('services.categories.secret');
    }

    /**
     * Get the full list of cars from the cars service
     * @return string
     */
    public function obtainCategories()
    {
        return $this->performRequest('GET', '/categories');
    }

    /**
     * Create an instance of car using the cars service
     * @return string
     */
    public function createCategory($data)
    {
        return $this->performRequest('POST', '/categories', $data);
    }

    /**
     * Get a single category from the category service
     * @return string
     */
    public function obtainCategory($category)
    {
        return $this->performRequest('GET', "/category/{$category}");
    }

    /**
     * Edit a single category from the category service
     * @return string
     */
    public function editCategory($data, $category)
    {
        return $this->performRequest('PUT', "/categories/{$category}", $data);
    }

    /**
     * Remove a single category from the category service
     * @return string
     */
    public function deleteCategory($category)
    {
        return $this->performRequest('DELETE', "/categories/{$category}");
    }


}
