<?php

namespace App\Data\Order;

use App\Data\DataInterface;
use App\Enum\Order\OrderStatus;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
class OrderData extends Data implements DataInterface
{
    public function __construct(
        public int $code,
        public OrderStatus $status,
        public ?string $description = null,
        public ?string $responsableId = null, 
    ) {
    }
}