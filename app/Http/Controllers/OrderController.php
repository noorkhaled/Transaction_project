<?php

namespace App\Http\Controllers;

use App\Models\Orders;
use App\Models\Products;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(){
        $orders = Orders::all();
    }
    public function store(Request $request){
        $request->validate([
            'products_ids'=>'required'
        ]);
        $order = Orders::create($request->all());
        $productIds = $request->input('id');
        $totalAmount = Products::whereIn('id',$productIds)->sum('price');
        $order->amount =  $totalAmount;
        $order->save();
        $order->products()->attach($productIds);
        return response($order,201);
    }
}
