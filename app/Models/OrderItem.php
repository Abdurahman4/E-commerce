<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Product;   
use App\Models\Order;     

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'product_id',
        'quantity',
        'price',
    ];

    // علاقة: عنصر الطلب يتبع لطلب
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    // علاقة: عنصر الطلب يتبع لمنتج
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
