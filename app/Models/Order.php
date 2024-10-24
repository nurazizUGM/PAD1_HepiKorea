<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    public static $status = ['unconfirmed', 'confirmed', 'unpaid', 'paid', 'processing', 'shipment_unpaid', 'shipment_paid', 'sending', 'sent', 'finished', 'cancelled'];
    public static $type = ['order', 'custom'];

    protected $fillable = [
        'user_id',
        'total_items_price',
        'service_price',
        'status',
        'type'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function customOrderItems()
    {
        return $this->hasMany(CustomOrderItem::class);
    }

    // public function orderDetail()
    // {
    //     return $this->hasOne(OrderDetail::class);
    // }

    // public function orderShipment()
    // {
    //     return $this->hasOne(OrderShipment::class);
    // }

    // public function orderPayment()
    // {
    //     return $this->hasMany(OrderPayment::class);
    // }

    // public function orderStatus()
    // {
    //     return $this->hasMany(OrderStatus::class);
    // }
}