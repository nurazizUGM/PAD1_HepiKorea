<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderShipment extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'shipment_service',
        'price',
        'tracking_code',
        'arrival_estimation',
    ];

    public $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'arrival_estimation' => 'datetime',
    ];
}
