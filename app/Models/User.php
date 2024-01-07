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
    protected $fillable = [
        'name',
        'email',
        'password',
        'account_id',
        'account_type',
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
    public  function transactions(){
        return $this->hasMany(Transactions::class);
    }
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
//    public function fromableTransactions()
//    {
//        return $this->belongsToMany(Transactions::class, 'transaction_user', 'user_fromable_id', 'transaction_id');
//    }
//
//    public function toableTransactions()
//    {
//        return $this->belongsToMany(Transactions::class, 'transaction_user', 'user_toable_id', 'transaction_id');
//    }
}
