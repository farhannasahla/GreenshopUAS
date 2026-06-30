<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;

Route::resource('products', ProductController::class);
Route::get('/categories', [CategoryController::class, 'index']);