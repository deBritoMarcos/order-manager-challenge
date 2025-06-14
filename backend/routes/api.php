<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api;

Route::post('/webhook/order', Api\Webhook\Order\Store::class);

Route::prefix('orders')->name('orders.')->group(function () {
    Route::get('/', Api\Order\Index::class)->name('index');
    
    Route::put('/{id}/situation', Api\Order\Situation\Update::class)->name('update.situation');
});