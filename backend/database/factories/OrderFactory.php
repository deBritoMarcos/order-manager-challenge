<?php

namespace Database\Factories;

use App\Enum\Order\OrderStatus;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    public function definition(): array
    {
        return [
            'code' => random_int(000000, 999999),
            'status' => OrderStatus::Pending,
            'description' => null,
            'user_id' => null,
        ];
    }
}
