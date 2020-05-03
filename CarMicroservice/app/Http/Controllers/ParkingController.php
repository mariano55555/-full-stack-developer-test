<?php

namespace App\Http\Controllers;

use App\Parking;
use Carbon\Carbon;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

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
                        ->where('end_time', false)
                        ->orderBy('updated_at', 'desc')
                        ->first();
        if($record){

            $now        = Carbon::now();
            $startTime  = Carbon::parse($record->start_time["date"]);
            $finishTime = Carbon::parse($now);
            $totalDuration = $finishTime->diffInSeconds($startTime);
            $record->end_time = $now;
            $record->diff = $totalDuration / 60;
            $record->save();

        }else{
            $record = Parking::create([
                'license_plate' => $request->license_plate,
                'start_time' => Carbon::now(),
                'end_time' => false
            ]);
        }

        return $this->successResponse($record, Response::HTTP_CREATED);
    }


    public function show(Request $request, $month = null, $year = null)
    {
        $month = isset($month) ? $month : date("n");
        $year  = isset($year) ? $year : date("Y");

        $start = Carbon::create()->month(4)->year($year)->startOfMonth();
        $end   = Carbon::create()->month(5)->year($year)->endOfMonth();

        $parking = DB::table('parking')
                        ->where('start_time', '>=', $start)
                        ->where('end_time', '<=', $end)
                        ->get();

        return $this->successResponse($parking);
    }

}
