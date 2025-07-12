<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api;

Route::post('/webhook/order', Api\Webhook\Order\Store::class);

Route::post('/login', Api\Auth\Login::class)->name('login');
Route::post('/logout', Api\Auth\Logout::class)->name('logout');

Route::middleware('auth:sanctum')->group(function () {
    Route::prefix('orders')->name('orders.')->group(function () {
        Route::get('/', Api\Order\Index::class)->name('index');
        Route::get('/{id}', Api\Order\Show::class)->name('show');
        
        Route::put('/{id}/situation', Api\Order\Situation\Update::class)->name('update.situation');
    });
});