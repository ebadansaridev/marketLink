<?php

namespace App\Repositories;

use App\Models\Market;
use App\Repositories\Contracts\MarketRepositoryInterface;

class MarketRepository extends BaseRepository implements MarketRepositoryInterface
{
    public function __construct(Market $model)
    {
        parent::__construct($model);
    }

    public function findNearby(float $lat, float $lng, float $radiusKm = 10)
    {
        // Haversine formula in SQL
        return $this->model
            ->selectRaw("*, (6371 * acos(cos(radians(?)) * cos(radians(latitude))
                * cos(radians(longitude) - radians(?)) + sin(radians(?))
                * sin(radians(latitude)))) AS distance", [$lat, $lng, $lat])
            ->having('distance', '<', $radiusKm)
            ->orderBy('distance')
            ->get();
    }
}