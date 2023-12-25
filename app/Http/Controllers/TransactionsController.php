<?php

namespace App\Http\Controllers;

use App\Models\Transactions;
use Illuminate\Http\Request;

class TransactionsController extends Controller
{
        public function index(){
            return Transactions::all();
        }
        public function show($id){
            return Transactions::findOrfail($id);
        }
        public function store(Request $request){
            $data = $request->validate([
                'user_id' => 'required|exists:users,id',
                'order_id' => 'required|integer',
                'type' => 'required|exists:types,id',
                'from_id' => 'required|exists:users,account_id',
                'to_id' => 'required|exists:users,account_id',
                'from_type' => 'required|exists:users,account_type',
                'to_type' => 'required|exists:users,account_type',
                'amount' => 'required|numeric',
                'balance' => 'required|numeric',
            ]);
            $transaction = Transactions::create($data);
            return response()->json($transaction,201);
        }
        public function update(Request $request,$id){
            $transaction = Transactions::findOrfail($id);
            $data = $request->validate([
                'user_id' => 'required|exists:users,id',
                'order_id' => 'required|integer',
                'type' => 'required|exists:types,id',
                'from_id' => 'required|exists:users,account_id',
                'to_id' => 'required|exists:users,account_id',
                'from_type' => 'required|exists:users,account_type',
                'to_type' => 'required|exists:users,account_type',
                'amount' => 'required|numeric',
                'balance' => 'required|numeric',
            ]);
            $transaction->update($data);
            return response()->json($transaction,201);
        }
        public function destroy($id){
            $transaction = Transactions::findOrfail($id);
            $transaction->delelt();
            return response()->json(null,204);
        }
}
