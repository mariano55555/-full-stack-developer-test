<?php

namespace App\Http\Controllers;


use App\Parking;
use Carbon\Carbon;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Date;

class ParkingController extends Controller
{

    use ApiResponser;


    public function index()
    {
        $parking = Parking::all();
        return $this->successResponse($parking);
    }


    public function store(Request $request)
    {
        $rules = [
            'license_plate' => 'required|max:255',
        ];

        $this->validate($request, $rules);

        $record = Parking::where('license_plate', $request->license_plate)
                        ->whereNull('end_time')
                        ->orderBy('updated_at', 'desc')
                        ->first();

        $now = Carbon::now();

        if($record){


            $startTime  = Carbon::parse($record->start_time);
            $finishTime = Carbon::parse($now);

            $totalDuration = $finishTime->diffInSeconds($startTime);

            $record->end_time = $now;
            $record->diff = $totalDuration / 60;
            $record->save();

        }else{
            $record                = new Parking;
            $record->license_plate = $request->license_plate;
            $record->start_time    = $now;
            $record->end_time      = null;
            $record->diff          = 0;
            $record->save();
        }

        return $this->successResponse($record, Response::HTTP_CREATED);
    }


    public function show(Request $request)
    {
        $month = isset($request->month) ? $request->month : date("n");
        $year  = isset($request->year) ? $request->year : date("Y");

        $start = Carbon::create()->month($month)->year($year)->startOfMonth();
        $end   = Carbon::create()->month($month)->year($year)->endOfMonth();

        $parking = Parking::where('start_time', '>=', $start)
                        ->where('end_time', '<=', $end)
                        ->get();

        return $this->successResponse($parking);
    }

}
