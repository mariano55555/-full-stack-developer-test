<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;


class Parking extends Model
{

    protected $collection = 'parking';

    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'license_plate', 'start_time', 'end_time', 'diff '
    ];



    protected $dates = ['deleted_at','start_time', 'end_time'];
    //protected $dates = ['deleted_at'];
}
