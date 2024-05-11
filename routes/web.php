<?php

use App\Http\Controllers\BrandsController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', [HomeController::class, 'index'])->name('dashboard');


Route::prefix('brand')->group(function () {
    Route::get('/', [BrandsController::class, 'index'])->name('brand.index');
    Route::get('/all', [BrandsController::class, 'all'])->name('brand.all');
    Route::post('/store', [BrandsController::class, 'store'])->name('brand.store');
    Route::delete('/{brand_id}/delete', [BrandsController::class, 'delete'])->name('brand.delete');
    Route::get('/{brand_id}/get', [BrandsController::class, 'get'])->name('brand.get');
    Route::post('/{brand_id}/update', [BrandsController::class, 'update'])->name('brand.update');
});

Route::prefix('category')->group(function () {
    Route::get('/', [CategoryController::class, 'index'])->name('category.index');
    Route::get('/all', [CategoryController::class, 'all'])->name('category.all');
    Route::post('/store', [CategoryController::class, 'store'])->name('category.store');
    Route::delete('/{category_id}/delete', [CategoryController::class, 'delete'])->name('category.delete');
    Route::get('/{category_id}/get', [CategoryController::class, 'get'])->name('category.get');
    Route::post('/{category_id}/update', [CategoryController::class, 'update'])->name('category.update');
});

require __DIR__.'/auth.php';
