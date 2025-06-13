<?php

namespace App\Providers;

use App\Service\Order\Contracts\ControlOrderProgressServiceInterface;
use App\Service\Order\Contracts\OrderGetterServiceInterface;
use App\Service\Order\ControlOrderProgressService;
use App\Service\Order\OrderGetterService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(
            ControlOrderProgressServiceInterface::class,
            ControlOrderProgressService::class
        );

        $this->app->bind(
            OrderGetterServiceInterface::class,
            OrderGetterService::class
        );
    }

    public function boot(): void
    {
        //
    }
}
