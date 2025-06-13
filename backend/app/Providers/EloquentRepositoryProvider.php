<?php

namespace App\Providers;

use App\Models\Order;
use App\Repository\Order\Contracts\OrderEloquentRepositoryInterface;
use App\Repository\Order\OrderEloquentRepository;
use Illuminate\Support\ServiceProvider;

class EloquentRepositoryProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(
            OrderEloquentRepositoryInterface::class,
            fn () => new OrderEloquentRepository(new Order())
        );
    }
}