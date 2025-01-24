<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductControllerApi;

Route::get('/productos', [ProductControllerApi::class, 'index'])->name('api.products.index');
Route::get('/productos/{product}', [ProductControllerApi::class, 'show'])->name('api.products.show');
Route::post('/productos', [ProductControllerApi::class, 'store'])->name('api.products.store');
Route::put('/productos/{product}', [ProductControllerApi::class, 'update'])->name('api.products.update');
Route::delete('/productos/{product}', [ProductControllerApi::class, 'destroy'])->name('api.products.destroy');
