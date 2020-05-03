<?php

return [
    'cars' => [
        'base_uri' => env('CARS_SERVICE_BASE_URL'),
        'secret' => env('CARS_SERVICE_SECRET'),
    ],

    'categories' => [
        'base_uri' => env('CATEGORIES_SERVICE_BASE_URL'),
        'secret' => env('CATEGORIES_SERVICE_SECRET'),
    ],

    'parking' => [
        'base_uri' => env('PARKING_SERVICE_BASE_URL'),
        'secret' => env('PARKING_SERVICE_SECRET'),
    ],
];
