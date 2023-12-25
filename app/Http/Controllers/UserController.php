<?php

namespace App\Http\Controllers;

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
//        $data = $request->validate([
//            'name' => 'required|string',
//            'email' => 'required|email|unique:users,email',
//            'password' => 'required|string',
//            'account_id' => 'required|integer',
//            'account_type' => 'required|string',
//            'balance' => 'required|numeric',
//        ]);

        $user = User::create($request->all());
        return response()->json($user, 201);
    }

    public function update(Request $request, User $user)
    {
//        $user = User::findOrFail($id);

//        $data = $request->validate([
//            'name' => 'required|string',
//            'email' => 'required|email|unique:users,email,'.$id,
//            'password' => 'required|string',
//            'account_id' => 'required|integer',
//            'account_type' => 'required|integer',
//            'balance' => 'required|numeric',
//        ]);

        $user->update($request->all());
        return response()->json($user, 200);
    }

    public function destroy(User $user)
    {
//        $user = User::findOrFail($id);
        $user->delete();
        return response()->json(null, 204);
    }
    public function sentTransactions(User $user)
    {
        $sentTransactions = $user->sentTransactions;
        return response()->json($sentTransactions);
    }

    public function receivedTransactions(User $user)
    {
        $receivedTransactions = $user->receivedTransactions;
        return response()->json($receivedTransactions);
    }
}
