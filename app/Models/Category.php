<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = [
        'category_name',
        'parent_id',
        'image'
    ];
    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id')->withDefault([
            'category_name' => 'No Parent',
        ]);
    }
    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }
    public function products()
    {
        return $this->hasMany(Product::class, 'category_id', 'id');
    }
    // public function products()
    // {
    //     return $this->hasMany(Product::class);
    // }
}
