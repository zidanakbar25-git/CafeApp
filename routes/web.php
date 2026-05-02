<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\PaymentCashController;

Route::get('/', function () {
    return view('welcome');
});

// MENU
Route::get('/table/{table}', [MenuController::class, 'index'])
    ->name('menu.index');

// CART
Route::get('/cart/{order_id?}', [CartController::class, 'index'])
    ->name('cart.index')
    ->defaults('order_id', 1);

Route::post('/cart/add', [CartController::class, 'addItem'])
    ->name('cart.add');

Route::post('/cart/update-qty-ajax', [CartController::class, 'updateQtyAjax'])
    ->name('cart.updateQtyAjax');

Route::post('/cart/delete-ajax', [CartController::class, 'deleteItemAjax'])
    ->name('cart.deleteItemAjax');

Route::post('/cart/checkout/{order_id}', [CartController::class, 'checkout'])
    ->name('cart.checkout');

Route::get('/cart/count/{order_id}', [CartController::class, 'getCount'])
    ->name('cart.count');

Route::get('/cart/checkout/{order_id}', [CartController::class, 'showCheckout']);

// PAYMENT
Route::get('/payment/{order_id}', [PaymentController::class, 'index'])
    ->name('payment.index');

Route::get('/payment/qris/{order_id}', [PaymentController::class, 'qris'])
    ->name('payment.qris');

// Payment page
Route::get('/payment/{order_id}', [PaymentController::class, 'index'])
    ->name('payment.index');

Route::get('/payment/cash/{order_id}', [PaymentCashController::class, 'show'])
    ->name('payment.cash.show');

// QRIS
Route::post('/payment/process/{order_id}', [PaymentController::class, 'process'])
    ->name('payment.process');
