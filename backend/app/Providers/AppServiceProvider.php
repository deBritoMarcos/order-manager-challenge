<?php

namespace App\Providers;

use App\Service\Order\Contracts\ControlOrderProgressServiceInterface;
use App\Service\Order\ControlOrderProgressService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(
            ControlOrderProgressServiceInterface::class,
            ControlOrderProgressService::class
        );
    }

    public function boot(): void
    {
        //
    }
}
