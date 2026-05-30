<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\MenuController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PaymentCashController;
use App\Http\Controllers\AdminLoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\TableController;

/*
|--------------------------------------------------------------------------
| ROOT
|--------------------------------------------------------------------------
*/

Route::redirect('/', '/table/1')->name('home');

/*
|--------------------------------------------------------------------------
| MENU
|--------------------------------------------------------------------------
*/

Route::get('/table/{table}', [MenuController::class, 'index'])
    ->name('menu.index');

/*
|--------------------------------------------------------------------------
| CART
|--------------------------------------------------------------------------
*/

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

/*
|--------------------------------------------------------------------------
| PAYMENT
|--------------------------------------------------------------------------
*/

Route::get('/payment/{order_id}', [PaymentController::class, 'index'])
    ->name('payment.index');

Route::get('/payment/qris/{order_id}', [PaymentController::class, 'qris'])
    ->name('payment.qris');

Route::get('/payment/cash/{order_id}', [PaymentCashController::class, 'show'])
    ->name('payment.cash.show');

Route::post('/payment/process/{order_id}', [PaymentController::class, 'process'])
    ->name('payment.process');

Route::get('/payment/cc/{order_id}', [PaymentController::class, 'cc'])
    ->name('payment.cc');

Route::get('/payment/success/{order_id}', [PaymentController::class, 'success'])
    ->name('payment.success');

Route::post('/payment/finalize/{order_id}', [PaymentController::class, 'finalizePayment'])
    ->name('payment.finalize');

/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/

Route::get('/login', [AdminLoginController::class, 'showLogin'])
    ->name('login');

Route::post('/login', [AdminLoginController::class, 'login']);

Route::get('/logout', [AdminLoginController::class, 'logout'])
    ->name('logout');

/*
|--------------------------------------------------------------------------
| ADMIN DASHBOARD — butuh login
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('admin.dashboard');

    /*
    |--------------------------------------------------------------------------
    | ORDER — Kasir & Manager bisa update status
    |--------------------------------------------------------------------------
    */
    Route::patch('/admin/orders/{id}/status', [OrderController::class, 'updateStatus'])
        ->name('admin.orders.updateStatus');

    Route::delete('/admin/orders/{id}', [OrderController::class, 'destroy'])
        ->name('admin.orders.destroy');

    Route::get('/admin/orders/{id}/struk', [OrderController::class, 'struk'])
        ->name('admin.orders.struk');

    /*
    |--------------------------------------------------------------------------
    | HALAMAN MANAGER ONLY
    |--------------------------------------------------------------------------
    */
    Route::middleware('role:manager')->group(function () {

        Route::get('/admin/tables', function () {
            return 'Tables Page';
        })->name('admin.tables.index');

        Route::get('/admin/menu', function () {
            return 'Menu Page';
        })->name('admin.menu.index');

        Route::get('/admin/admins', function () {
            return 'Admins Page';
        })->name('admin.admins.index');

    });

    /*
    |--------------------------------------------------------------------------
    | RIWAYAT — Manager & Kasir bisa lihat
    |--------------------------------------------------------------------------
    */
    Route::get('/admin/orders/history', [HistoryController::class, 'index'])->name('admin.orders.history');


    // Admin - Manajemen Meja
Route::prefix('admin')->middleware(['auth'])->name('admin.')->group(function () {
    // ... route admin lainnya ...

    Route::get('/tables', [TableController::class, 'index'])->name('tables.index');
    Route::post('/tables', [TableController::class, 'store'])->name('tables.store');
    Route::post('/tables/{table}/regenerate', [TableController::class, 'regenerate'])->name('tables.regenerate');
    Route::delete('/tables/{table}', [TableController::class, 'destroy'])->name('tables.destroy');
    Route::get('/tables/{table}/print', [TableController::class, 'print'])->name('tables.print');
});

    
});