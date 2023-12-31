<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use mysql_xdevapi\Table;

class Products extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'quantity',
        'price',
        'merchant_id',
    ];
    protected $table = 'products';
    public function merchants(){
        return $this->belongsTo(Merchants::class);
    }
    public function orders(){
        return $this->belongsToMany(Orders::class);
    }
}
