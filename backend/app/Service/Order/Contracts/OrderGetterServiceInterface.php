<?php

namespace App\Service\Order\Contracts;

use Illuminate\Support\Collection;

interface OrderGetterServiceInterface
{
    public function getAll(): Collection;

    public function getFiltering(?int $code, ?string $status): Collection;
}