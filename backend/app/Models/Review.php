<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $primaryKey = 'review_id';

    protected $fillable = [
        'product_id', 'farmer_id', 'customer_id',
        'rating', 'comment', 'farmer_reply',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'product_id');
    }

    public function farmer()
    {
        return $this->belongsTo(FarmerProfile::class, 'farmer_id', 'farmer_id');
    }

    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id', 'user_id');
    }
}