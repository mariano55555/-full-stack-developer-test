<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

/**
 * CARS
 */
$router->get('/cars', 'CarController@index');
$router->post('/cars', 'CarController@store');
$router->get('/car/{car}', 'CarController@show');
$router->put('/cars/{car}', 'CarController@update');
$router->patch('/cars/{car}', 'CarController@update');
$router->delete('/cars/{car}', 'CarController@destroy');

/**
 * CATEGORIES
 */

$router->get('/categories', 'CarCategoryController@index');
$router->post('/categories', 'CarCategoryController@store');
$router->get('/category/{category}', 'CarCategoryController@show');
$router->put('/categories/{category}', 'CarCategoryController@update');
$router->patch('/categories/{category}', 'CarCategoryController@update');
$router->delete('/categories/{category}', 'CarCategoryController@destroy');
$router->get('/categories/getregisterable', 'CarCategoryController@getregisterable');
