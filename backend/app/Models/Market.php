<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Market extends Model
{
    protected $primaryKey = 'market_id';

    protected $fillable = [
        'market_name', 'address', 'latitude', 'longitude',
        'map_provider', 'operating_days', 'timings',
    ];

    public function farmers()
    {
        return $this->hasMany(FarmerProfile::class, 'market_id', 'market_id');
    }
}