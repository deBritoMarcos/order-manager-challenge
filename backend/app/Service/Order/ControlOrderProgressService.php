<?php

namespace App\Service\Order;

use App\Data\Order\OrderData;
use App\Enum\Order\OrderStatus;
use App\Models\Order;
use App\Repository\Order\Contracts\OrderEloquentRepositoryInterface;
use App\Service\Order\Contracts\ControlOrderProgressServiceInterface;

class ControlOrderProgressService implements ControlOrderProgressServiceInterface
{
    public function __construct(
        private OrderEloquentRepositoryInterface $orderRepository
    ) {}

    public function register(int $code): Order
    {
        $orderData = new OrderData(
            code: $code,
            status: OrderStatus::Pending
        );

        return $this->orderRepository->create($orderData);
    }

    // public function updateOrder(Order $order): Order 
    // {

    // }
}