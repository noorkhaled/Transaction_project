<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transactions extends Model
{
    use HasFactory;

    //Here are the fillabel attributes that required when you want to create a new transaction
    protected $fillable=[
        //the id of user who will create this transaction
        'user_id',
        //the order_id that this transaction will belong to
        'order_id',
        //the type of the transaction
        'type',
        //the account will send the transaction
        'fromable_account_type',
        //the account will receive this transaction
        'toable_account_type',
        //the account_id of  transaction`s sender
        'fromable_account_id',
        //the account_id of transaction`s receiver
        'toable_account_id',
        //the amount of this transaction
        'amount',
        //the total balance of the order
        'balance',
    ];
    protected $table = 'transaction';

    //relation between user and transaction that every transaction belong to user
    public function user(){
        return $this->belongsTo(User::class);
    }
    //relation between order and transaction that every transaction should belong to an order
    public function orders(){
        return $this->belongsTo(Orders::class);
    }
    //polymorphic relation between transaction`s table and user`s table that relate transaction`s sender to fromable_account_type and fromable_account_id
    public function fromable()
    {
        return $this->morphTo('fromable_account','fromable_account_type','fromable_account_id');
    }

    //polymorphic relation between transaction`s table and user`s table that relate transaction`s receiver to toable_account_type and toable_account_id
    public function toable()
    {
        return $this->morphTo('toable_account','toable_account_type','toable_account_id');
    }

    protected static function boot()
    {
        parent::boot();
        //simple function responsible to user`s balances as updating it when transaction took place
        static::updated(function (Transactions $transaction){

            $transaction->load('fromable','toable');
            $amountdifferece = $transaction->getOriginal('amount') - $transaction->amount;

            $sender = $transaction->fromable_account;
            $receiver = $transaction->toable_account;

            if($amountdifferece > 0){
                $sender->balance += $amountdifferece;
                $receiver->balance -= $amountdifferece;
          }elseif($amountdifferece<0){
                $sender->balance -= abs($amountdifferece);
                $receiver->balance += abs($amountdifferece);
            }

            $sender->save();
            $receiver->save();
        });
    }
}
