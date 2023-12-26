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
        'to_id',
        'from_type',
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
//           public function supdateBalances()
//    {
//        $this->load('from', 'to');
//
//        if ($this->from && $this->to) {
//
//            $sender = $this->from;
//            $receiver = $this->to;
//
//            $sender->balance -= $this->amount;
//            $receiver->balance += $this->amount;
//
//            $sender->save();
//            $receiver->save();
//        }
//    }


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

//    protected static function boot()
//    {
//        parent::boot();
//        static::created(function ($transaction){
//            $fromUser = $transaction->from;
//            $fromUser->balance -= $transaction->amount;
//            $fromUser->save();
//
//            $toUser = $transaction->to;
//            $toUser->balance += $transaction->amount;
//            $toUser->save();
//        });
//    }
}
