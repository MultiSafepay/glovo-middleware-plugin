<?php

declare(strict_types=1);

use GlovoPlugin\Http\Controllers\Order;
use Illuminate\Support\Facades\Route;

Route::prefix('glovo')->group(
    function () {
        Route::post('orders/dispatched', [Order::class, 'dispatched']);
        Route::post('orders/accepted', [Order::class, 'accepted']);
        Route::post('orders/cancelled', [Order::class, 'cancelled']);
    }
);
