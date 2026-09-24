<?php

namespace App\Repositories\Contracts;

interface ReviewRepositoryInterface extends BaseRepositoryInterface
{
    public function getProductReviews(int $productId);
    public function getFarmerReviews(int $farmerId);
    public function addFarmerReply(int $reviewId, string $reply);
}