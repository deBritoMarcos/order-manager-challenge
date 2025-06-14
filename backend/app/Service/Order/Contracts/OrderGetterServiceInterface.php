<?php

namespace App\Service\Order\Contracts;

use App\Models\Order;
use Illuminate\Support\Collection;

interface OrderGetterServiceInterface
{
    public function getAll(): Collection;

    public function getFiltering(?int $code, ?string $status): Collection;

    public function getOne(string $id): ?Order;
}