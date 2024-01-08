<?php

namespace App\Http\Controllers;

use App\Models\Transactions;
use Illuminate\Http\Request;
use App\Http\Requests\TransactionRequest;

class TransactionsController extends Controller
{
    //Index function is used here to retrieve all transactions in DB
    public function index()
    {
        $transactions = Transactions::all();
        if (!$transactions) {
            return response()->json([
                'success' => false,
                'message' => "not transactions found"
            ]);
        }
        return response()->json([
            'success' => true,
            'transactions'=>$transactions
            ], 201);
    }
    //store function is to create new transaction
    public function store(Request $request, TransactionRequest $transactionRequest)
    {
        if (!$request->validate($transactionRequest->rules()))
        {
            return response()->json([
                'success'=>false,
                'message'=>'cannot create transaction',
            ]);
        }
        $transaction = Transactions::create($request->all());
        return response()->json([
            'success'=> true,
            'message' => 'Transaction Created successfully',
            'transaction' => $transaction
            ], 201);
        }
        //show function is used to retrieve a specific transaction by it`s ID
    public function show($id)
    {
        $transaction = Transactions::find($id);
        if (!$transaction) {
            return response()->json([
                'success' => false,
                'message' => "Cannot locate Transaction with ID: '$id'"
            ]);
        }
        return response()->json([
            'success' => true,
            'transaction'=>$transaction
        ], 201);
    }
    //update function is to first retrieve a specific transaction by ID like show give it the attributes i want to update
    public function update(Request $request, Transactions $transaction, TransactionRequest $transactionRequest)
    {
        $originalAttributes = $transaction->getOriginal();
        if (!$request->validate($transactionRequest->rules())) {
            return response()->json([
                    'success' => false,
                    'message' => 'Cannot update Transaction']
                , 201);
        }
        $transaction->update($request->all());
        $updatedAttributes = collect($transaction->getAttributes())
            ->filter(function ($value, $key) use ($originalAttributes) {
                return $originalAttributes[$key] != $value;
            });
        return response()->json([
            $transaction,
            'message' => 'Transaction Updated successfully',
            'updated_attributes'=> $updatedAttributes
        ], 201);
    }
    //delete function is used to delete a specific transaction with it`s ID
    public function delete($id)
    {
        $transaction = Transactions::find($id);
        if (!$transaction) {
            return response()->json([
                'success' => false,
                'message' => "Transaction with ID: '$id' not found"
            ]);
        }
        $transaction->delete();
        return response()->json([
            'success' => true,
            'message' => "Transaction with ID: '$id' deleted",
        ], 201);
    }
}
