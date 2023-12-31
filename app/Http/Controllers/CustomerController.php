<?php

namespace App\Http\Controllers;

use App\Models\Customers;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index(){
        $customer = Customers::all();
        return response()->json($customer,201);
    }
    public function store(Request $request){
        $request->validate([
            'name'=>'required',
            'email'=>'required',
            'password'=>'required',
            'balance'=>'required',
        ]);
        $customer = Customers::create($request->all());
        return response()->json($customer,201);
    }
}
