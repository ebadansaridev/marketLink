<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $primaryKey = 'order_id';

    protected $fillable = [
        'customer_id', 'farmer_id', 'total_amount', 'order_status',
        'pickup_date', 'pickup_slot', 'notes',
    ];

    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id', 'user_id');
    }

    public function farmer()
    {
        return $this->belongsTo(FarmerProfile::class, 'farmer_id', 'farmer_id');
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class, 'order_id', 'order_id');
    }
}