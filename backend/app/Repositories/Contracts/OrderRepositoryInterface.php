<?php

namespace App\Repositories\Contracts;

interface OrderRepositoryInterface extends BaseRepositoryInterface
{
    public function getCustomerOrders(int $customerId);
    public function getFarmerOrders(int $farmerId);
    public function updateStatus(int $orderId, string $status);
}