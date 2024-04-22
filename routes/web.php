<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
Route::get('/', function () {
    return view('welcome');
});
Route::post('/create', [ProductController::class, 'createProduct'])->name('createProduct');
