<?php
use App\Http\Controllers\PaymentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\PaymentCashController;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/table/{table}', [MenuController::class, 'index'])
    ->name('menu.index');
    
// Show cart (order_id = 1 as dummy)
Route::get('/cart/{order_id?}', [CartController::class, 'index'])
    ->name('cart.index')
    ->defaults('order_id', 1);
 
// AJAX update qty → return JSON
Route::post('/cart/update-qty-ajax', [CartController::class, 'updateQtyAjax'])
    ->name('cart.updateQtyAjax');

// AJAX delete item → return JSON  
Route::post('/cart/delete-ajax', [CartController::class, 'deleteItemAjax'])
    ->name('cart.deleteItemAjax');
     
// Checkout
Route::post('/cart/checkout/{order_id}', [CartController::class, 'checkout'])
    ->name('cart.checkout');

// Add item to cart via AJAX
Route::post('/cart/add', [CartController::class, 'addItem'])
    ->name('cart.add');

// Get cart count via AJAX  
Route::get('/cart/count/{order_id}', [CartController::class, 'getCount'])
    ->name('cart.count');

Route::get('/cart/checkout/{id}', [CartController::class, 'showCheckout']);

Route::post('/cart/checkout/{id}', [CartController::class, 'checkout']);


// Payment page
Route::get('/payment/{order_id}', [PaymentController::class, 'index'])
    ->name('payment.index');

Route::get('/payment/cash/{order_id}', [PaymentCashController::class, 'show'])
    ->name('payment.cash.show');

