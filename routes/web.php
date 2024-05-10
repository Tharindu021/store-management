<?php

use App\Http\Controllers\BrandsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', [HomeController::class, 'index'])->name('dashboard');


Route::prefix('brand')->group(function () {
    Route::get('/', [BrandsController::class, 'index'])->name('item-brand.show');
    Route::get('/all', [BrandsController::class, 'show'])->name('item-brand.all');
    Route::post('/store', [BrandsController::class, 'store'])->name('item-brand.store');
});

require __DIR__.'/auth.php';
