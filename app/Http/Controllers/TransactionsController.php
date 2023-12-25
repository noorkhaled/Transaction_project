<?php

namespace App\Http\Controllers;

use App\Models\Transactions;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class TransactionsController extends Controller
{
//        public function index(){
//            return Transactions::all();
//        }
//        public function show(Transactions $transaction){
//            return response()->json($transaction);
//        }
    public function store(Request $request)
    {
        try {
            $request->validate([
//                'user_id' => 'required|exists:users,id',
//                'order_id' => 'required|integer',
//                'type' => 'required|exists:types,id',
//                'from_id' => 'required|exists:users,account_id',
//                'to_id' => 'required|exists:users,account_id',
//                'from_type' => 'required|exists:users,account_type',
//                'to_type' => 'required|exists:users,account_type',
//                'amount' => 'required|numeric',
//                'balance' => 'required|numeric',
                'user_id' => 'required',
                'order_id' => 'required',
                'type' => 'required',
                'from_id' => 'required',
                'to_id' => 'required',
                'amount' => 'required',
                'balance' => 'required',
            ]);

            $fromuser = User::find($request->from_id);
            $touser = User::find($request->to_id);

            if (!$fromuser || !$touser) {
                return response()->json(['error' => 'Invalid User`s ID'], 422);
            }

            $transactionData = $request->all();
            $transactionData['from_type'] = $fromuser->account_type;
            $transactionData['to_type'] = $touser->account_type;
            $transaction = Transactions::create($transactionData);
//            $transaction->updateBalances();
            return response()->json($transaction, 201);
        }
        catch (QueryException $exception) {
            return response()->json([
                'error' => 'Internal server error',
                'message' => 'failed to create the transaction'
            ],500);
        }
        catch (\Exception $exception) {
            return response()->json([
                'error' => 'Internal server error',
                'message' => $exception->getMessage()
            ],500);
        }
    }
//        public function update(Request $request,$id){
//            $transaction = Transactions::findOrfail($id);
//            $data = $request->validate([
//                'user_id' => 'required|exists:users,id',
//                'order_id' => 'required|integer',
//                'type' => 'required|exists:types,id',
//                'from_id' => 'required|exists:users,account_id',
//                'to_id' => 'required|exists:users,account_id',
//                'from_type' => 'required|exists:users,account_type',
//                'to_type' => 'required|exists:users,account_type',
//                'amount' => 'required|numeric',
//                'balance' => 'required|numeric',
//            ]);
//            $transaction->update($data);
//            return response()->json($transaction,201);
//        }
//        public function destroy($id){
//            $transaction = Transactions::findOrfail($id);
//            $transaction->delelt();
//            return response()->json(null,204);
//        }
}
