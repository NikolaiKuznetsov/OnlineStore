<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'product_id',
        'price',
        'quantity',
    ];

    public $timestamps = false;

    public function order()
    {
        return $this->hasMany(Order::class);
    }

    public function product()
    {
        return $this->hasMany(Product::class);
    }
}
