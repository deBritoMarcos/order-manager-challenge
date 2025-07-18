<?php

namespace App\Service\Order;

use App\Data\Order\OrderData;
use App\Data\Order\UpdateOrderData;
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

    public function update(Order $order, OrderData $newOrderData): Order 
    {
        if ($order->status === OrderStatus::Finished) {
            return $order;
        }

        return match ($order->status) {
            OrderStatus::Pending => $this->changeToStarted($order, $newOrderData),
            OrderStatus::Started => $this->changeToFinished($order, $newOrderData),
            default => $this->invalidSituation($order),
        };
    }

    private function changeToStarted(Order $order, OrderData $newOrderData): Order 
    {
        $updateData = UpdateOrderData::from([
            'status' => OrderStatus::Started,
            'responsableId' => $newOrderData->responsableId, 
        ]);

        $this->orderRepository->update($order, $updateData);

        return $order->fresh();
    }

    private function changeToFinished(Order $order, OrderData $newOrderData): Order 
    {
        $updateData = UpdateOrderData::from([
            'status' => OrderStatus::Finished,
            'description' => $newOrderData->description, 
        ]);

        $this->orderRepository->update($order, $updateData);

        return $order->fresh();
    }

    private function invalidSituation(Order $order): Order 
    {
        return $order;
    }
}