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

    public function update(Order $order): Order 
    {
        if ($order->status === OrderStatus::Finished) {
            return $order;
        }

        return match ($order->status) {
            OrderStatus::Pending => $this->updateSituation($order, OrderStatus::Started),
            OrderStatus::Started => $this->updateSituation($order, OrderStatus::Finished),
            default => $this->invalidSituation($order),
        };
    }

    private function updateSituation(Order $order, OrderStatus $nextStatus): Order 
    {
        $this->orderRepository
            ->updateSituation($order->id, $nextStatus);

        return $order->fresh();
    }

    private function invalidSituation(Order $order): Order 
    {
        return $order;
    }
}