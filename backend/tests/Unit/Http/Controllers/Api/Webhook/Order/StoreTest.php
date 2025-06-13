<?php

use App\Models\Order;
use App\Service\Order\Contracts\ControlOrderProgressServiceInterface;
use Illuminate\Http\Response;

it('returns `Unprocessable Entity status code` when a invalid param is given', function (mixed $state, mixed $code) {
    $this->mock(ControlOrderProgressServiceInterface::class)
        ->shouldNotReceive('register')
        ->getMock();

    $this->postJson('api/webhook/order', [
        "state" => $state,
        "orderCode" => $code,
    ])
        ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
})
    ->with([
        'missing state' => ['state' => null, 'code' => 123456],
        'incorrect state' => ['state' => 'update', 'code' => 123456],
        'missinge code' => ['state' => 'create', 'code' => null],
        'code without integer value' => ['state' => 'create', 'code' => 'abc'],
    ]);

it('returns `Unprocessable Entity status code` when given code already exists', function () {
    Order::factory()->create([
        'code' => 123456
    ]);
    
    $this->mock(ControlOrderProgressServiceInterface::class)
        ->shouldNotReceive('register')
        ->getMock();

    $this->postJson('api/webhook/order', [
        "state" => "create",
        "orderCode" => 123456,
    ])
        ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
});

it('registers the order with expected data', function () {
    $this->mock(ControlOrderProgressServiceInterface::class)
        ->shouldReceive('register')
        ->withArgs([123456])
        ->getMock();

    $this->postJson('api/webhook/order', [
        "state" => "create",
        "orderCode" => 123456,
    ])
        ->assertStatus(Response::HTTP_CREATED);
});