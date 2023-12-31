<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;

class ProductController extends Controller
{
        public function index(){
            $products = Products::all();
        }
        public function store(Request $request){
            $request->validate([
                'name'=>'required',
                'quantity'=>'required',
                'price'=>'required',
                'merchant_id'=>'required'
            ]);
            $product = Products::create($request->all());
            return response()->json($product,201);
        }
}
