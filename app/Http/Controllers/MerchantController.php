<?php

namespace App\Http\Controllers;

use App\Models\Merchants;
use Illuminate\Http\Request;

class MerchantController extends Controller
{
    public function index(){
        $merchant = Merchants::all();
        return response()->json($merchant,201);
    }
    public function store(Request $request){
        $request->validate([
            'name'=>'required',
            'email'=>'required',
            'password'=>'required',
            'balance'=>'required',
        ]);
        $merchant = Merchants::create($request->all());
        return response()->json($merchant,201);
    }
}
