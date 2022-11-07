<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'image',
        'country',
        'year',
        'model',
        'quantity',
    ];

    public function category()
    {
        return $this->belongsToMany(Category::class);
    }

    public function cart()
    {
        return $this->hasMany(Cart::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}
