<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transactions extends Model
{
    use HasFactory;
    protected $fillable=[
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
        return $this->belongsTo(User::class,'from_id','account_id')
            ->where('from_type','account_type');
    }
    public function to(){
        return $this->belongsTo(User::class,'to_id','account_to')
            ->where('to_type','account_type');
    }
}
