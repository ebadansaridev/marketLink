<?php

namespace App\Repositories;

use App\Models\Review;
use App\Repositories\Contracts\ReviewRepositoryInterface;

class ReviewRepository extends BaseRepository implements ReviewRepositoryInterface
{
    public function __construct(Review $model)
    {
        parent::__construct($model);
    }

    public function getProductReviews(int $productId)
    {
        return $this->model->with('customer')
            ->where('product_id', $productId)
            ->orderByDesc('created_at')
            ->get();
    }

    public function getFarmerReviews(int $farmerId)
    {
        return $this->model->with(['customer', 'product'])
            ->where('farmer_id', $farmerId)
            ->orderByDesc('created_at')
            ->get();
    }

    public function addFarmerReply(int $reviewId, string $reply)
    {
        $review = $this->findOrFail($reviewId);
        $review->farmer_reply = $reply;
        $review->save();
        return $review;
    }
}