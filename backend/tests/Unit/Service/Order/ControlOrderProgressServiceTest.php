<?php

use App\Data\Order\OrderData;
use App\Enum\Order\OrderStatus;
use App\Models\Order;
use App\Repository\Order\Contracts\OrderEloquentRepositoryInterface;
use App\Service\Order\Contracts\ControlOrderProgressServiceInterface;

it('must have a contract', function () {
    expect(app()->bound(OrderEloquentRepositoryInterface::class))
        ->toBeTrue();
});

test('`register` creates order with pending status', function () {
    $expectedData = new OrderData(
        code: 123456,
        status: OrderStatus::Pending
    );

    $this->mock(OrderEloquentRepositoryInterface::class)
        ->shouldReceive('create')
        ->once()
        ->withArgs(function(OrderData $data) use ($expectedData) {
            return $data->code === $expectedData->code
                && $data->status === $expectedData->status;
        })
        ->andReturn(Order::factory()->create([
            'code' => 123456,
            'status' => OrderStatus::Pending
        ]))
        ->getMock();
    
    $service = app()->make(ControlOrderProgressServiceInterface::class);

    $orderCreated = $service
        ->register(123456);

    expect($orderCreated)
        ->code->toBe(123456)
        ->status->toBe(OrderStatus::Pending);
});