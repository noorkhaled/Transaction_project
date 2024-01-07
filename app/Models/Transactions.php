<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transactions extends Model
{
    use HasFactory;
    protected $fillable=[
        'user_id',
        'order_id',
        'type',
        'fromable_account_type',
        'toable_account_type',
        'fromable_account_id',
        'toable_account_id',
        'amount',
        'balance',
    ];
    protected $table = 'transaction';
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function orders(){
        return $this->belongsTo(Orders::class);
    }
    public function fromable()
    {
        return $this->morphTo('fromable_account','fromable_account_type','fromable_account_id');
    }
    public function toable()
    {
        return $this->morphTo('toable_account','toable_account_type','toable_account_id');
    }

    protected static function boot()
    {
        parent::boot();
        static::created(function (Transactions $transaction){
            $transaction->load('fromable','toable');
            $sender = $transaction->fromable_account;
            $sender->balance -= $transaction->amount;
            $sender->save();

            $receiver = $transaction->toable_account;
            $receiver->balance += $transaction->amount;
            $receiver->save();
        });
    }
}
