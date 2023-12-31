<?php

namespace App\Http\Controllers;

use App\Models\Deliveries;
use Illuminate\Http\Request;

class DeliveryController extends Controller
{
    public function index(){
        $delivery = Deliveries::all();
        return response()->json($delivery,201);
    }
    public function store(Request $request){
        $request->validate([
            'name'=>'required',
            'email'=>'required',
            'password'=>'required',
            'balance'=>'required',
        ]);
        $delivery = Deliveries::create($request->all());
        return response()->json($delivery,201);
    }
}
