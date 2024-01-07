<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\TransactionService;
use App\Http\Requests\UsersRequest;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function index()
    {
        $users = User::all();
        if (!$users) {
            return response()->json([
                'success' => false,
                'message' => "not users found"
            ]);
        }
        return response()->json([
            'success' => true,
            'users'=>$users
        ], 201);
    }
    public function store(Request $request, UsersRequest $usersRequest)
    {
        if (!$request->validate($usersRequest->rules()))
        {
            return response()->json([
                'success'=>false,
                'message'=>'cannot create user',
            ]);
        }
        $user = User::create($request->all());
        return response()->json([
            'success'=> true,
            'message' => 'user Created successfully',
            'user' => $user
        ], 201);
    }
    public function show($userId)
    {
        $user = User::find($userId);
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => "Cannot locate user with ID: '$userId'"
            ]);
        }
        return response()->json([
            'success' => true,
            'user'=>$user
        ], 201);
    }
    public function update(Request $request, User $user, UsersRequest $usersRequest)
    {

        $originalAttributes = $user->getOriginal();
        if (!$request->validate($usersRequest->rules())) {
            return response()->json([
                    'success' => false,
                    'message' => 'Cannot update user']
                , 201);
        }
        $user->update($request->all());
        $updatedAttributes = collect($user->getAttributes())
            ->filter(function ($value, $key) use ($originalAttributes) {
                return $originalAttributes[$key] != $value;
            });
        return response()->json([
            'success' => true,
            'user'=>$user,
            'message' => 'User Updated successfully',
            'updated attributes'=>$updatedAttributes
            ], 201);
    }

    public function delete($id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => "cannot find user with id: '$id'"
            ], 201);
        }
        $user->delete();
        return response()->json([
            'success' => true,
            'message' => "user with id: '$id' deleted",
        ], 201);
    }





    protected $transactionServices;

    public function __construct(TransactionService $transactionServices)
    {
        $this->transactionServices = $transactionServices;
    }

    public function getUsersData($id)
    {

        $user = User::findOrFail($id);
        $sent = $this->transactionServices->sentTransactions($id);
        $receive = $this->transactionServices->receivedTransactions($id);
        $transactions = [
            'sent' => $sent,
            'received' => $receive
        ];

        return response()->json([$user, $transactions], 201);
    }

    public function getUserOrders($userId)
    {
        $user = User::with('orders')->findOrFail($userId);
        return response()->json($user->orders);
    }
}
