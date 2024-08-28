<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class MasterController extends Controller
{
    public function getList(){
        $masters = User::whereIn("role", ["MASTER","ADMIN"])->get();
        return response()->json(['masters' => $masters], 200);
    }

    public function getListForAppointment(){
        $masters = User::select('lastname', 'firstname', 'id')->whereIn("role", ["MASTER","ADMIN"])->get();
        return response()->json(['masters' => $masters], 200);
    }

    public function edit(string $id, Request $request) {
        User::find($id)->update([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'middlename' => $request->middlename,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
        ]);

        return response()->json(true,200);
    }

    public function remove(string $master_id){
        User::where('id', '=', $master_id)->delete();

        return response()->json(true,200);
    }

    public function create(Request $request) {
        User::create([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'middlename' => $request->middlename,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
        ]);

        return response()->json(true,200);
    }
}
