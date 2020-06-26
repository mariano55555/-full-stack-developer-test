<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;


class Car extends Model
{

    protected $collection = 'cars';

    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'license_plate', 'brand', 'color', 'year', 'category'
    ];



    protected $dates = ['deleted_at'];

    public function car_category()
    {
        return $this->belongsTo(CarCategory::class, 'category');
    }
}
