<?php

namespace App\Repository\Order\Contracts;

use App\Data\Order\OrderFilterData;
use Illuminate\Support\Collection;

interface OrderEloquentRepositoryInterface
{
    public function getByFilter(OrderFilterData $orderFilterData): Collection;
}