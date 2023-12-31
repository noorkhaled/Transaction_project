<?php

namespace App\Http\Controllers;

use App\Models\Transactions;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users =  User::all();
        return response()->json($users);
    }

    public function show(User $user)
    {
        return response()->json($user);
    }

    public function store(Request $request)
    {
        $user = User::create($request->all());
        return response()->json($user, 201);
    }

    public function update(Request $request, User $user)
    {
        $user->update($request->all());
        return response()->json($user, 201);
    }

    public function delete($id)
    {
        $user = User::find($id);
        if ($user) {
            $user->delete();
        }
        return response()->json([
            'success' => true,
            'message' => 'user deleted ',
        ], 200);
    }
        public function sentTransactions($userId)
        {
            $user = User::findOrFail($userId);

            // Fetch transactions where 'to_id' equals the user's 'account_id'
            $transactions = Transactions::where('from_id', $user->account_id)
                ->get();

            return response()->json($transactions,201);
        }

        public function receivedTransactions($userId)
        {
            $user = User::findOrFail($userId);

            // Fetch transactions where 'to_id' equals the user's 'account_id'
            $transactions = Transactions::where('to_id', $user->account_id)
                ->get();

            return response()->json($transactions,201);
        }
        public function getUsersData($id){

            $user = User::findOrfail($id);
            $sent = $this->sentTransactions($id);
            $receive = $this->receivedTransactions($id);

            $transactions = [
              'sent'=>$sent,
              'received'=>$receive
            ];

            return response()->json([$user,$transactions],201);
        }
}
