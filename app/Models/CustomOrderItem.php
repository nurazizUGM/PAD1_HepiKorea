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
        'url',
        'description',
        'quantity',
        'estimated_price',
        'total_price',
        'is_available'
    ];
}
