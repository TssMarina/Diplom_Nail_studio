<?php

namespace App\Http\Controllers\Admin;

use App\Models\Appointment;
use App\Request\AppointmentRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AppointmentController extends Controller
{
    public function getList(){
        $appointments = Appointment::join('users', 'users.id', '=', 'appointment.master_id')
            ->join('favour', 'favour.id', '=', 'appointment.favour_id')
            ->select('appointment.id as id', 'appointment.datetime as datetime', 'appointment.name as name', 'appointment.phone as phone','appointment.status as status', 'users.lastname as lastname','users.firstname as firstname','favour.name as favour_name')
            ->orderBy('datetime', 'asc') //сортировка datetime по возрастанию
            ->get();

        $appointments = $appointments->map(function ($item){
            return [
                'id' => $item->id,
                'datetime' => Carbon::make($item->datetime)->format('d.m H:i'),
                'name' => $item->name,
                'phone' => $item->phone,
                'status' => $item->status,
                'master_name' => $item->lastname.' '.$item->firstname,
                'favour_name' => $item->favour_name,
            ];
        });

        return response()->json(['appointments'=> $appointments],200);
    }

    public function create(AppointmentRequest $request) {
        return response()->json($request->save(),200);
    }

    public function editStatus(string $id, Request $request) {
        Appointment::find($id)->update([
            'status' => $request->status,
        ]);

        return response()->json(true,200);
    }
}
