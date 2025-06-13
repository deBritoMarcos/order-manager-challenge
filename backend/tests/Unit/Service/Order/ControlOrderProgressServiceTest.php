<?php

use App\Data\Order\OrderData;
use App\Enum\Order\OrderStatus;
use App\Repository\Order\Contracts\OrderEloquentRepositoryInterface;
use App\Service\Order\Contracts\ControlOrderProgressServiceInterface;

beforeEach(function () {
    $this->service = app()->make(ControlOrderProgressServiceInterface::class);
});

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
        ->withArgs(function(OrderData $data) use ($expectedData) {
            return $data->code === $expectedData->code
                && $data->status === $expectedData->status;
        })
        ->getMock();

    $orderCreated = $this->service
        ->register(123456);

    expect($orderCreated)
        ->code->toBe(123456)
        ->status->toBe(OrderStatus::Pending);
});