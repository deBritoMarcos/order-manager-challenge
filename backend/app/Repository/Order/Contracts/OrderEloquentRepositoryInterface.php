<?php

namespace App\Repository\Order\Contracts;

use App\Data\Order\OrderFilterData;
use App\Enum\Order\OrderStatus;
use Illuminate\Support\Collection;

interface OrderEloquentRepositoryInterface
{
    public function getByFilter(OrderFilterData $orderFilterData): Collection;

    public function updateSituation(string $id, OrderStatus $newStatus): bool;
}