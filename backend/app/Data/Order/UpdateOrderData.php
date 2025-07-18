<?php

namespace App\Data\Order;

use App\Data\DataInterface;
use App\Enum\Order\OrderStatus;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;
use Spatie\LaravelData\Optional;

#[MapName(SnakeCaseMapper::class)]
class UpdateOrderData extends Data implements DataInterface
{
    public function __construct(
        public OrderStatus $status,
        public string|Optional $description,
        public string|Optional $responsableId, 
    ) {
    }
}