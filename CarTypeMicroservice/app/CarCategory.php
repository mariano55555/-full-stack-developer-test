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



    protected $dates = ['deleted_at'];
}
