<?php

use App\Data\Order\OrderFilterData;
use App\Enum\Order\OrderStatus;
use App\Models\Order;
use App\Repository\Order\Contracts\OrderEloquentRepositoryInterface;
use App\Service\Order\Contracts\OrderGetterServiceInterface;
use Illuminate\Support\Str;

it('must have a contract', function () {
    expect(app()->bound(OrderGetterServiceInterface::class))
        ->toBeTrue();
});

test('`getFiltering` must filter by expected params', function () {
    $expectedOrder = Order::factory()->create([
        'code' => 123456,
        'status' => OrderStatus::Pending
    ]);

    $expectedData = new OrderFilterData(
        code: 123456,
        status: OrderStatus::Pending
    );

    $repositoryMock = Mockery::mock(OrderEloquentRepositoryInterface::class)
        ->shouldReceive('getByFilter')
        ->once()
        ->withArgs(function(OrderFilterData $data) use ($expectedData) {
            return $data->code === $expectedData->code
                && $data->status === $expectedData->status;
        })
        ->andReturn(collect([$expectedOrder->first()]))
        ->getMock();

    $repositoryMock->shouldNotReceive('all')
        ->getMock();

    $this->app->instance(OrderEloquentRepositoryInterface::class, $repositoryMock);

    $service = app()->make(OrderGetterServiceInterface::class);

    $service->getFiltering(123456, 'pending');
});

test('`getFiltering` returns all when do not have filter params', function () {
    $expectedOrders = Order::factory(count: 2)->create();

    $repositoryMock = Mockery::mock(OrderEloquentRepositoryInterface::class)
        ->shouldNotReceive('getByFilter')
        ->getMock();

    $repositoryMock->shouldReceive('all')
        ->once()
        ->andReturn(collect([$expectedOrders]))
        ->getMock();

    $this->app->instance(OrderEloquentRepositoryInterface::class, $repositoryMock);

    $service = app()->make(OrderGetterServiceInterface::class);

    $service->getFiltering(null, null);
});

test('`getOne` returns null when the id is invalid', function () {
    $this->mock(OrderEloquentRepositoryInterface::class)
        ->shouldNotReceive('find')
        ->getMock();

    $service = app()->make(OrderGetterServiceInterface::class);

    expect($service->getOne('id'))
        ->toBeNull();
});

test('`getOne` returns null when not found the order', function () {
    $id = (string) Str::uuid();

    $this->mock(OrderEloquentRepositoryInterface::class)
        ->shouldReceive('find')
        ->once()
        ->withArgs([$id])
        ->andReturn(null)
        ->getMock();

    $service = app()->make(OrderGetterServiceInterface::class);

    expect($service->getOne($id))
        ->toBeNull();
});

test('`getOne` returns expected order', function () {
    $order = Order::factory()->create();

    $this->mock(OrderEloquentRepositoryInterface::class)
        ->shouldReceive('find')
        ->once()
        ->withArgs([$order->id])
        ->andReturn($order)
        ->getMock();

    $service = app()->make(OrderGetterServiceInterface::class);

    expect($service->getOne($order->id))
        ->toBe($order);
});