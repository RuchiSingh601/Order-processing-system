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
        'user_id',
        'price',
        'quantity',
        'other_charges',
        'total_charges',
        'warehouse_id',
        'delivery_date'
    ];

    public function order()
    {
    return $this->belongsTo(Order::class);
    }
    public function orderItems()
{
    return $this->hasMany(OrderItem::class);
}
}
