<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\SupplyController;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware(['auth'])->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Rutas para el CRUD básico
    Route::resource('users', UserController::class);
    Route::resource('products', ProductController::class);
    Route::resource('categorias', CategoriaController::class);

    // Rutas relacionadas con ventas
    Route::prefix('sales')->name('sales.')->group(function () {
        Route::get('/', [SaleController::class, 'index'])->name('index');
        Route::get('/create', [SaleController::class, 'create'])->name('create');
        Route::post('/store', [SaleController::class, 'store'])->name('store');
        Route::get('/product/{id}', [SaleController::class, 'getProduct'])->name('product');
        Route::post('/validate-stock', [SaleController::class, 'validateStock'])->name('validateStock');
        Route::get('/{sale}', [SaleController::class, 'show'])->name('show');
        Route::delete('/{sale}', [SaleController::class, 'destroy'])->name('destroy');
    });

    // Rutas relacionadas con abastecimiento
    Route::prefix('supplies')->name('supplies.')->group(function () {
        Route::get('/', [SupplyController::class, 'index'])->name('index');
        Route::get('/create', [SupplyController::class, 'create'])->name('create');
        Route::post('/store', [SupplyController::class, 'store'])->name('store');
        Route::get('/{supply}', [SupplyController::class, 'show'])->name('show');
        Route::delete('/{supply}', [SupplyController::class, 'destroy'])->name('destroy');
    });

});

require __DIR__.'/auth.php';
