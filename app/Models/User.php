<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    //Here are the fillabel attributes that required when you want to create a new user
    protected $fillable = [
        //user name
        'name',
        //user email
        'email',
        //user email`s password
        'password',
        //user account_id
        'account_id',
        //user account_type
        'account_type',
        //user account balance
        'balance'
    ];
    protected $hidden = [
        'password',
        'remember_token',
    ];
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
    protected $table = 'users';
    //relation between user and transaction that user can create many transactions
    public  function transactions(){
        return $this->hasMany(Transactions::class);
    }

    //relation between user and orders that user can belong to many orders
    public function orders(){
        return $this->belongsToMany(Orders::class,'order_user','user_id','order_id')
                ->withPivot('user_type');
    }

    public function sentTransactions():  \Illuminate\Database\Eloquent\Relations\MorphMany
    {
        return $this->morphMany(Transactions::class, 'fromable_account','fromable_account_type','fromable_account_id','account_id');
    }

    public function receivedTransactions():  \Illuminate\Database\Eloquent\Relations\MorphMany
    {
        return $this->morphMany(Transactions::class, 'toable_account','toable_account_type','toable_account_id','account_id');
    }
}
