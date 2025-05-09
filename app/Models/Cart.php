<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    // use HasFactory;

    // public function products(){
//     return $this->hasMany(Product::class);
// }
protected $fillable = [
        'user_id',
        'product_id',
        'quantity',
        'price',
        'total',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // public function product()
    // {
    //     return $this->hasMany(Product::class);
    // }
}
