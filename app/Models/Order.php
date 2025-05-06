<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'warehouse_id',
        'total_amount',
        'order_number',
        'order_date',
        'delivery_date',
        'user_id',
        'payment_id',
        'status',
    ];
    public function items()
    {
    return $this->hasMany(OrderItem::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class, 'order_id');
    }
    public function paymentMethod()
    {
        return $this->belongsTo(PaymentMethod::class, 'payment_id');
    }

}
