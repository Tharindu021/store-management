<?php

use App\Http\Controllers\BrandsController;
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

require __DIR__.'/auth.php';
