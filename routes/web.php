<?php

use App\Http\Controllers\BrandsController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\ProductContraller;
use App\Http\Controllers\ProductImageController;
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
    Route::post('/select/brand/delete', [BrandsController::class, 'deleteSelectedItems'])->name('brand.delete.selected');
    Route::post('/select/brand/inactive', [BrandsController::class, 'inactiveSelectedItems'])->name('brand.inactive.selected');
    Route::post('/select/brand/active', [BrandsController::class, 'activeSelectedItems'])->name('brand.active.selected');
});

Route::prefix('category')->group(function () {
    Route::get('/', [CategoryController::class, 'index'])->name('category.index');
    Route::get('/all', [CategoryController::class, 'all'])->name('category.all');
    Route::post('/store', [CategoryController::class, 'store'])->name('category.store');
    Route::delete('/{category_id}/delete', [CategoryController::class, 'delete'])->name('category.delete');
    Route::get('/{category_id}/get', [CategoryController::class, 'get'])->name('category.get');
    Route::post('/{category_id}/update', [CategoryController::class, 'update'])->name('category.update');
    Route::post('/select/category/delete', [CategoryController::class, 'deleteSelectedItems'])->name('category.delete.selected');
    Route::post('/select/categoryinactive', [CategoryController::class, 'inactiveSelectedItems'])->name('category.inactive.selected');
    Route::post('/select/category/active', [CategoryController::class, 'activeSelectedItems'])->name('category.active.selected');
});

Route::prefix('product')->group(function () {
    Route::get('/', [ProductContraller::class, 'index'])->name('product.index');
    Route::get('/all', [ProductContraller::class, 'all'])->name('product.all');
    Route::post('/store', [ProductContraller::class, 'store'])->name('product.store');
    Route::get('/{prductId}/edit', [ProductContraller::class, 'edit'])->name('product.edit');
    Route::delete('/{product_id}/delete', [ProductContraller::class, 'delete'])->name('products.basic.delete');
    Route::get('/{product_id}/get', [ProductContraller::class, 'get'])->name('product.get');
    Route::post('/{product_id}/update', [ProductContraller::class, 'update'])->name('products.basic.update');
    Route::post('/select/product/delete', [ProductContraller::class, 'deleteSelectedItems'])->name('product.delete.selected');
    Route::post('/select/product/inactive', [ProductContraller::class, 'inactiveSelectedItems'])->name('product.inactive.selected');
    Route::post('/select/product/active', [ProductContraller::class, 'activeSelectedItems'])->name('product.active.selected');
    Route::post('/{product_id}/product/image/store', [ImageController::class, 'store'])->name('product.image.store');
    Route::get('/{product_id}/product/image/getProduct', [ProductImageController::class, 'getProduct'])->name('product.image.getProduct');
    Route::get('/{product_id}/product/image/getImage', [ProductImageController::class, 'getImage'])->name('product.image.getImage');
});

require __DIR__.'/auth.php';
