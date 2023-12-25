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
    protected $table = 'transactions';
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function from(){
        return $this->morphTo('from');
    }
    public function to(){
        return $this->morphTo('to');
    }
    protected static function boot()
    {
        parent::boot();
        static::created(function ($transaction){
            $fromUser = $transaction->from;
            $fromUser->balance -= $transaction->amount;
            $fromUser->save();

            $toUser = $transaction->to;
            $toUser->balance += $transaction->amount;
            $toUser->save();
        });
    }
}
