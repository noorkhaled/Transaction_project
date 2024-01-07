<?php

namespace App\Services;

use App\Models\Transactions;
use App\Models\User;

class TransactionService
{
    public function sentTransactions($userId)
    {
        $user = User::findOrFail($userId);

        $transactions = Transactions::where('fromable_account_id', $user->account_id)
            ->get();

        return response()->json($transactions,201);
    }

    public function receivedTransactions($userId)
    {
        $user = User::findOrFail($userId);

        $transactions = Transactions::where('toable_account_id', $user->account_id)
            ->get();

        return response()->json($transactions,201);
    }
}
