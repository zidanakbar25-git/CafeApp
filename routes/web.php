<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

//route untuk halaman home
Route::get('/', [HomeController::class, 'index']);


?>