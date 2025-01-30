<?php

use App\Http\Controllers\ProductControllerApi;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TrackingController;
use App\Http\Controllers\PriceController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';




use App\Http\Controllers\ProductViewController;

// Rutas para manejar vistas de productos
Route::get('/productos', [ProductViewController::class, 'index'])->name('products.index');
Route::get('/productos/crear', [ProductViewController::class, 'create'])->name('products.create');
Route::post('/productos', [ProductViewController::class, 'store'])->name('products.store');
Route::get('/productos/{product}/editar', [ProductViewController::class, 'edit'])->name('products.edit');
Route::put('/productos/{product}', [ProductViewController::class, 'update'])->name('products.update');
Route::delete('/productos/{product}', [ProductViewController::class, 'destroy'])->name('products.destroy');



Route::resource('trackings', TrackingController::class);
Route::post('trackings/{tracking}/prices', [PriceController::class, 'store'])->name('trackings.prices.store');


Route::post('trackings/{tracking}/prices', [PriceController::class, 'store'])->name('prices.store');
