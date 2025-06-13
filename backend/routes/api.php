<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api;

Route::post('/webhook/order', Api\Webhook\Order\Store::class);

// Route::prefix('orders')->name('orders.')->group(function () {
//     Route::get('/', [Index::class]);
// });