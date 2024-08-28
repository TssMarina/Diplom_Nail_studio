<?php

namespace App\Http\Controllers\Admin;

use App\Models\Favour;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FavourController extends Controller
{
    public function getList(){
        $favours = Favour::all();

        return response()->json(['favours'=> $favours],200);
    }

    public function getListForAppointment(){
        $favours = Favour::select('id', 'name')->get();

        return response()->json(['favours'=> $favours],200);
    }

    public function remove(string $favour_id){
        Favour::where('id', '=', $favour_id)->delete();

        return response()->json(true,200);
    }

    public function create(Request $request) {
        Favour::create([
            'name' => $request->name,
            'price' => $request->price,
            'category' => $request->category
        ]);

        return response()->json(true,200);
    }

    public function edit(string $id, Request $request) {
        Favour::find($id)->update([
            'name' => $request->name,
            'price' => $request->price,
            'category' => $request->category
        ]);

        return response()->json(true,200);
    }

    public function getCategories() {
        return response()->json(['categories' => ['MANICURE', 'PEDICURE']], 200);
    }
}
