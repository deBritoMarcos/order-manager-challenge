<?php

use App\Enum\Order\OrderStatus;
use App\Models\Order;
use App\Service\Order\Contracts\ControlOrderProgressServiceInterface;
use App\Service\Order\Contracts\OrderGetterServiceInterface;
use Illuminate\Support\Arr;

it('returns `Not Found status code` when the order not found', function () {
    $order = Order::factory()->create([
        'status' => OrderStatus::Finished
    ]);

    $this->mock(OrderGetterServiceInterface::class)
        ->shouldReceive('getOne')
        ->once()
        ->withArgs([$order->id])
        ->andReturn(null)
        ->getMock();

    $this->mock(ControlOrderProgressServiceInterface::class)
        ->shouldNotReceive('update')
        ->getMock();

    $this->putJson(route('orders.update.situation', ['id' => $order->id]))
        ->assertNotFound();
});

it('returns `Ok status code` when the order is updated', function () {
    $order = Order::factory()->create([
        'status' => OrderStatus::Finished
    ]);

    $this->mock(OrderGetterServiceInterface::class)
        ->shouldReceive('getOne')
        ->once()
        ->withArgs([$order->id])
        ->andReturn($order)
        ->getMock();

    $this->mock(ControlOrderProgressServiceInterface::class)
        ->shouldReceive('update')
        ->once()
        ->withArgs([$order])
        ->andReturn($order)
        ->getMock();

    $this->putJson(route('orders.update.situation', ['id' => $order->id]))
        ->assertOk();
});