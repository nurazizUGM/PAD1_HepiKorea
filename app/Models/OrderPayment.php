<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderPayment extends Model
{
    use HasFactory;

    static $paymentType = ['items', 'shipment'];
    static $status = ['pending', 'paid', 'failed'];

    protected $fillable = [
        'order_id',
        'payment_type',
        'status',
        'amount',
        'payment_code',
        'transaction_id',
        'expired_at',
        'paid_at',
    ];

    protected $casts = [
        'expired_at' => 'datetime',
        'paid_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
