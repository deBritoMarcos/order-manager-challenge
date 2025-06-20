<?php

use App\Data\Order\OrderData;
use App\Enum\Order\OrderStatus;
use App\Models\Order;
use App\Repository\Order\OrderEloquentRepository;

beforeEach(function () {
    $this->repository = new OrderEloquentRepository(new Order());
});

test('`all` returns all datas', function () {
    $orders = Order::factory(count: 3)->create();

    $ordersReturned = $this->repository
        ->all();

    expect($ordersReturned)
        ->toArray()
        ->toMatchArray($orders->toArray());
});

test('`create` creates order with expected data', function () {
    $orderData = new OrderData(
        code: 987654,
        status: OrderStatus::Pending
    );

    $orderCreated = $this->repository
        ->create($orderData);

    expect($orderCreated)
        ->code->toBe(987654)
        ->status->toBe(OrderStatus::Pending);
});