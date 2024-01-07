<?php

namespace App\Http\Controllers;

use App\Models\Orders;
use App\Models\User;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(){
        $orders = Orders::all();
        return response($orders,201);
    }
    public function store(Request $request){
        $order = Orders::create($request->all());
        return response()->json($order,201);
    }
    public function ShowUserOrders($orderId,$userId,$usertype){
        $order = Orders::find($orderId);
        $user = User::find($userId);

        $order->users()->attach($user->id,['user_type'=>$usertype]);
        return response()->json($order,201);
    }
}
