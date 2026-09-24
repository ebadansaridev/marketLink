<?php

namespace App\Repositories\Contracts;

interface MarketRepositoryInterface extends BaseRepositoryInterface
{
    public function findNearby(float $lat, float $lng, float $radiusKm = 10);
}