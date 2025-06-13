<?php

namespace App\Data\Order;

use App\Enum\Order\OrderStatus;
use Illuminate\Http\Request;
use Spatie\LaravelData\Data;

class OrderData extends Data
{
    public function __construct(
        public int $code,
        public OrderStatus $status,
    ) {
    }

    public static function fromWebhook(Request $request): OrderData
    {
        $fields = $request->validated();
    
        return new self(
            $fields['orderCode'],
            OrderStatus::Pending,
        );
    }
}