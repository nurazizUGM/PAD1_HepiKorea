<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomOrderItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'name',
        'quantity',
        'estimated_price',
        'total_price',
        'url',
        'description',
        'image',
        'is_available',
        'admin_note'
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function orderDetail()
    {
        return $this->hasOneThrough(OrderDetail::class, Order::class, 'id', 'order_id');
    }
}
