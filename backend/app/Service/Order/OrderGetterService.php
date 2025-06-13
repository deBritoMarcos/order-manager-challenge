<?php

namespace App\Service\Order;

use App\Data\Order\OrderFilterData;
use App\Enum\Order\OrderStatus;
use App\Repository\Order\Contracts\OrderEloquentRepositoryInterface;
use App\Service\Order\Contracts\OrderGetterServiceInterface;
use Illuminate\Support\Collection;

class OrderGetterService implements OrderGetterServiceInterface
{
    public function __construct(
        private OrderEloquentRepositoryInterface $orderRepository
    ) {}

    public function getAll(): Collection
    {
        return $this->orderRepository->all();
    }

    public function getFiltering(?int $code, ?string $status): Collection
    {
        if (!empty($code) || !empty($status)) {
            
            $orderFilterData = OrderFilterData::fromQueryParams($code, $status);

            return $this->orderRepository->getByFilter($orderFilterData);
        }

        return $this->getAll();
    }
}