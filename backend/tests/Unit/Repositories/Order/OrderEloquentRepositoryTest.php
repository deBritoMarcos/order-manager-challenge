<?php

use App\Data\Order\OrderFilterData;
use App\Enum\Order\OrderStatus;
use App\Models\Order;
use App\Repository\Order\OrderEloquentRepository;

beforeEach(function () {
    $this->repository = new OrderEloquentRepository(new Order());
});

test('`getByFilter` creates order with expected data', function () {
    Order::factory(count: 2)->create();

    $expectedOrder = Order::factory()->create([
        'code' => 987654,
        'status' => OrderStatus::Pending
    ]);

    $orderFilterData = new OrderFilterData(
        code: 987654,
        status: OrderStatus::Pending
    );

    $ordersReturned = $this->repository
        ->getByFilter($orderFilterData);
    
    expect($ordersReturned)
        ->toHaveCount(1)
        ->and($ordersReturned[0])
            ->id->toBe($expectedOrder->id)
            ->code->toBe($expectedOrder->code)
            ->status->toBe($expectedOrder->status);
});