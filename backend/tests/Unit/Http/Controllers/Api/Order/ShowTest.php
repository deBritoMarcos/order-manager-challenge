<?php

use App\Enum\Order\OrderStatus;
use App\Models\Order;
use App\Service\Order\Contracts\OrderGetterServiceInterface;
use Illuminate\Support\Str;

it('returns `Not Found status code` when the order not found', function () {
    $id = (string) Str::uuid();

    $this->mock(OrderGetterServiceInterface::class)
        ->shouldReceive('getOne')
        ->once()
        ->withArgs([$id])
        ->andReturn(null)
        ->getMock();

    $this->getJson(route('orders.show', ['id' => $id]))
        ->assertNotFound();
});

it('returns `Ok status code` when the order is found', function () {
    $order = Order::factory()->create([
        'status' => OrderStatus::Finished
    ]);

    $this->mock(OrderGetterServiceInterface::class)
        ->shouldReceive('getOne')
        ->once()
        ->withArgs([$order->id])
        ->andReturn($order)
        ->getMock();

    $this->getJson(route('orders.show', ['id' => $order->id]))
        ->assertOk();
});