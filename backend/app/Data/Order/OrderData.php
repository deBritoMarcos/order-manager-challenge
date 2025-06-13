<?php

namespace App\Data\Order;

use App\Data\DataInterface;
use App\Enum\Order\OrderStatus;
use Illuminate\Http\Request;
use Spatie\LaravelData\Data;

class OrderData extends Data implements DataInterface
{
    public function __construct(
        public int $code,
        public OrderStatus $status,
    ) {
    }
}