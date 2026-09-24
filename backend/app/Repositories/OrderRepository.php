<?php

namespace App\Repositories;

use App\Models\Order;
use App\Repositories\Contracts\OrderRepositoryInterface;

class OrderRepository extends BaseRepository implements OrderRepositoryInterface
{
    public function __construct(Order $model)
    {
        parent::__construct($model);
    }

    public function getCustomerOrders(int $customerId)
    {
        return $this->model->with(['items.product', 'farmer'])
            ->where('customer_id', $customerId)
            ->orderByDesc('created_at')
            ->get();
    }

    public function getFarmerOrders(int $farmerId)
    {
        return $this->model->with(['items.product', 'customer'])
            ->where('farmer_id', $farmerId)
            ->orderByDesc('created_at')
            ->get();
    }

    public function updateStatus(int $orderId, string $status)
    {
        $order = $this->findOrFail($orderId);
        $order->order_status = $status;
        $order->save();
        return $order;
    }
}