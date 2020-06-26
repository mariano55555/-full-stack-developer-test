<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;


class CarCategory extends Model
{

    protected $collection = 'car_categories';

    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'price_per_minute', 'isRegisterable', 'isBillable', 'monthlyCharge'
    ];

    protected $casts = [
        'isRegisterable' => 'boolean',
        'isBillable'     => 'boolean',
        'monthlyCharge'  => 'boolean',
    ];


    protected $dates = ['deleted_at'];


    public function cars()
    {
        return $this->hasMany(Car::class, 'category');
    }
}
