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
    public  function transactions(){
        return $this->hasMany(Transactions::class);
    }
    public function sentTransactions(){
        return $this->hasMany(Transactions::class,'to_id','account_id')
            ->where('to_type','account_type');
    }
    public function recievedTransactions(){
        return $this->hasMany(Transactions::class,'from_id','account_id')
            ->where('from_type','account_type');
    }
}
