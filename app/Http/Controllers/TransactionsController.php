<?php

namespace App\Http\Controllers;

use App\Models\Transactions;
use Illuminate\Http\Request;

class TransactionsController extends Controller
{
        public function index(){
            $transactions = Transactions::all();
            return response()->json($transactions);
        }

        public function show(Transactions $transaction){
            return response()->json($transaction);
        }

            public function store(Request $request){

                 $request->validate([
                    'user_id' => 'required',
                    'order_id' => 'required',
                    'type' => 'required',
                    'to_id'=>'required',
                    'from_id'=>'required',
                    'from_type'=>'required',
                    'to_type'=>'required',
                    'amount' => 'required',
                  'balance' => 'required',
                ]);
                 $transaction = Transactions::create($request->all());
                return response()->json($transaction,201);
            }

    public function delete($id)
    {
        $transaction = Transactions::find($id);
        if ($transaction) {
            $transaction->delete();
        }
        return response()->json([
            'success' => true,
            'message' => 'Transaction deleted ',
        ], 200);
    }
}
