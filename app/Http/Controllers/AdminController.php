<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(){
        $admin = Admin::all();
        return response()->json($admin,201);
    }
    public function store(Request $request){
        $request->validate([
            'name'=>'required',
            'email'=>'required',
            'password'=>'required',
            'balance'=>'required',
        ]);
        $admin = Admin::create($request->all());
        return response()->json($admin,201);
    }
}
