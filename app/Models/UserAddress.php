<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAddress extends Model
{
    use HasFactory;
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'mobile',
        'address1',
        'address2',
        'country',
        'city',
        'state',
        'zip_code',
        'payment',
        'user_id'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
