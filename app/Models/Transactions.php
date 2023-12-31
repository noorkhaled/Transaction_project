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
        'from_id',
        'from_type',
        'to_id',
        'to_type',
        'amount',
        'balance',
    ];
    protected $table = 'transaction';
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function from(){
        return $this->morphTo('from','from_type','from_id');
    }
    public function to(){
        return $this->morphTo('to','to_type','to_id');
    }
    protected static function boot()
    {
        parent::boot();
        static::created(function (Transactions $transaction){
            $transaction->load('from','to');
            $sender = $transaction->from;
            $sender->balance -= $transaction->amount;
            $sender->save();

            $receiver = $transaction->to;
            $receiver->balance += $transaction->amount;
            $receiver->save();
        });
    }
}
