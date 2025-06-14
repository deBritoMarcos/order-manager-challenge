<?php

use App\Models\Order;
use App\Service\Order\Contracts\OrderGetterServiceInterface;
use Illuminate\Support\Arr;

it('returns all orders when the filter params is given', function () {
    $orders = Order::factory(count: 3)->create();

    $this->mock(OrderGetterServiceInterface::class)
        ->shouldReceive('getFiltering')
        ->once()
        ->withArgs([null, null])
        ->andReturn(collect($orders))
        ->getMock();

    $reponse = $this->get('api/orders');

    $content = json_decode($reponse->getContent());
    
    expect($content->data)
        ->toHaveCount(3);
});

it('returns expected orders according the filter gived', function () {
    Order::factory(count: 2)->create();

    $expectedOrder = Order::factory()->create([
        'code' => 123456
    ]);

    $this->mock(OrderGetterServiceInterface::class)
        ->shouldReceive('getFiltering')
        ->once()
        ->withArgs([123456, null])
        ->andReturn(collect([$expectedOrder]))
        ->getMock();

    $reponse = $this->get('api/orders?' . Arr::query(['code' => 123456]));
    
    $content = json_decode($reponse->getContent());
    
    expect($content->data)
        ->toHaveCount(1)
        ->and($content->data[0])
            ->toMatchArray($expectedOrder->toArray());
});