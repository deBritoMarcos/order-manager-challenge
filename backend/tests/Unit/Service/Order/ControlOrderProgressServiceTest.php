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

test('`update` does nothing when order is finished', function () {
    $order = Order::factory()->create([
        'status' => OrderStatus::Finished
    ]);

    $this->mock(OrderEloquentRepositoryInterface::class)
        ->shouldNotReceive('updateSituation')
        ->getMock();
    
    $service = app()->make(ControlOrderProgressServiceInterface::class);

    $orderUpdated = $service
        ->update($order);

    expect($orderUpdated)
        ->toBe($order);
});

test('`update` must update order to started when it is pending', function () {
    $order = Order::factory()->create([
        'status' => OrderStatus::Pending
    ]);
    
    $id = $order->id;
    $status = OrderStatus::Started;
    $this->mock(OrderEloquentRepositoryInterface::class)
        ->shouldReceive('updateSituation')
        ->once()
        ->withArgs(function ($expectedOrderId, $expectedStatus) use ($id, $status) {
            return $expectedOrderId == $id
                && $expectedStatus->value == $status->value;
        })
        ->andReturnTrue()
        ->getMock();
    
    $service = app()->make(ControlOrderProgressServiceInterface::class);

    $service->update($order);
});

test('`update` must update order to finished when it is started', function () {
    $order = Order::factory()->create([
        'status' => OrderStatus::Started
    ]);
    
    $id = $order->id;
    $status = OrderStatus::Finished;
    $this->mock(OrderEloquentRepositoryInterface::class)
        ->shouldReceive('updateSituation')
        ->once()
        ->withArgs(function ($expectedOrderId, $expectedStatus) use ($id, $status) {
            return $expectedOrderId == $id
                && $expectedStatus->value == $status->value;
        })
        ->andReturnTrue()
        ->getMock();
    
    $service = app()->make(ControlOrderProgressServiceInterface::class);

    $service->update($order);
});