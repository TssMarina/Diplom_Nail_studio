<?php

namespace App\Http\Controllers\Admin;

use App\Models\Calendar;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CalendarController extends Controller
{
    public function getList(){
        $calendars = Calendar::join('users', 'users.id', '=', 'calendar.master_id')
            ->select('calendar.date', 'calendar.time', 'calendar.id', 'users.lastname as master')
            ->get();
        $calendars->map(function ($calendar) {
            return [
                "id" => $calendar->id,
                "date" => $calendar->date,
                "time" => $calendar->time = array_map(function ($time) {
                        return $time->time;
                    }, json_decode($calendar->time)),
                "master" => $calendar->master
            ];
        });
        return response()->json(['calendars'=> $calendars],200);
    }
    public function getListForAppointment(Request $request){

        if ($request->master !== "null") {
            $calendars = Calendar::where('master_id', '=', $request->master)->get();
        }
        else $calendars = Calendar::all();

        $calendars->map(function ($calendar) {
            return [
                "date" => $calendar->date = Carbon::make($calendar->date)->format('d.m'),
                "time" => $calendar->time = array_filter(
                    array_map(function ($time) {
                        return $time->status === "free" ? $time->time : null;
                    }, json_decode($calendar->time)),
                    function ($item) {
                        return !is_null($item) ?? $item;
                    }),
            ];
        });
        return response()->json(['calendars'=> $calendars],200);
    }


    public function remove(string $calendar_id){
        Calendar::where('id', '=', $calendar_id)->delete();

        return response()->json(true,200);
    }

    public function create(Request $request) {
        $calendar = Calendar::where('date', '=', $request->date)
            ->where('master_id', '=', $request->master)
            ->first();
        if ($calendar) {
            return response()->json(['message' => 'День у мастера уже заполнен'],422);
        }
        Calendar::create([
            'date' => $request->date,
            'time' => json_encode($request->time),
            'master_id' => $request->master,
        ]);
        return response()->json(true,200);
    }
}
