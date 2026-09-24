<?php

namespace App\Repositories\Contracts;

interface ProductRepositoryInterface extends BaseRepositoryInterface
{
    public function filterProducts(array $filters);
    public function findByFarmer(int $farmerId);
    public function markSoldOut(int $productId);
}