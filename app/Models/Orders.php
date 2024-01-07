<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    use HasFactory;

    protected $table = 'orders';
    public function transactions(){
        return $this->hasMany(Transactions::class,'order_id');
    }
    public function users()
    {
        return $this->belongsToMany(User::class,'order_user','order_id','user_id')
            ->withPivot('user_type');
    }
}
