<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    use HasFactory;
    protected $fillable = [
        'amount',
        'num_of_products'
    ];

    protected $table = 'orders';
    public function products()
    {
        return $this->belongsToMany(Products::class);
    }
    public function delivries(){
        return $this->belongsToMany(Deliveries::class);
    }
    public function merchants(){
        return $this->belongsToMany(Merchants::class);
    }
    public function customers(){
        return $this->belongsToMany(Customers::class);
    }

}
