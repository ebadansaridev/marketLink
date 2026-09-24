<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FarmerProfile extends Model
{
    protected $primaryKey = 'farmer_id';

    protected $fillable = [
        'user_id', 'stall_name', 'contact_person', 'description',
        'market_id', 'operating_days', 'pickup_window', 'address',
        'latitude', 'longitude', 'order_cutoff_time',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public function market()
    {
        return $this->belongsTo(Market::class, 'market_id', 'market_id');
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'farmer_id', 'farmer_id');
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'farmer_id', 'farmer_id');
    }
}