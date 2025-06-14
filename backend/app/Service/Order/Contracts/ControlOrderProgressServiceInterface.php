<?php

namespace App\Service\Order\Contracts;

use App\Models\Order;

interface ControlOrderProgressServiceInterface
{
    public function register(int $code): Order;

    public function update(Order $order): Order;
}