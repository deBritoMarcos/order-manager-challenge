<?php

namespace App\Repository\Order;

use App\Data\Order\OrderFilterData;
use App\Enum\Order\OrderStatus;
use App\Repository\EloquentRepository;
use App\Repository\Order\Contracts\OrderEloquentRepositoryInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

class OrderEloquentRepository extends EloquentRepository implements OrderEloquentRepositoryInterface
{
    public function getByFilter(OrderFilterData $orderFilterData): Collection
    {
        $codeFilter = $orderFilterData->code;
        $statusFilter = $orderFilterData->status;

        return $this->model
            ->when($orderFilterData->code, function (Builder $query) use ($codeFilter) {
                $query->where('code', 'like', "%{$codeFilter}%");
            })
            ->when($orderFilterData->status, function (Builder $query) use ($statusFilter)  {
                $query->where('status', $statusFilter);
            })
            ->get();
    }

    public function updateSituation(string $id, OrderStatus $newStatus): bool
    {
        return $this->model
            ->where('id', $id)
            ->update([
                'status' => $newStatus
            ]);
    }
}