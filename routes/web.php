<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\SupplyController;
use App\Http\Controllers\DebtorController; // Importante

// Redirección al login
Route::get('/', function () {
    return redirect()->route('login');
});

// Solo usuarios autenticados
Route::middleware(['auth'])->group(function () {

    // Dashboard para todos los autenticados
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // RUTAS EXCLUSIVAS PARA ADMIN
    Route::middleware('role:admin')->group(function () {
        Route::resource('users', UserController::class); // gestionar usuarios
    });

    // RUTAS COMPARTIDAS (admin y vendedor)
    Route::middleware('role:admin|vendedor')->group(function () {

        // Productos
        Route::resource('products', ProductController::class);

        // Categorías
        Route::resource('categorias', CategoriaController::class);

        // Ventas
        Route::prefix('sales')->name('sales.')->group(function () {
            Route::get('/', [SaleController::class, 'index'])->name('index');
            Route::get('/create', [SaleController::class, 'create'])->name('create');
            Route::post('/store', [SaleController::class, 'store'])->name('store');
            Route::get('/product/{id}', [SaleController::class, 'getProduct'])->name('product');
            Route::post('/validate-stock', [SaleController::class, 'validateStock'])->name('validateStock');
            Route::get('/{sale}', [SaleController::class, 'show'])->name('show');

            // Solo los administradores pueden eliminar las ventas
            Route::middleware('role:admin')->delete('/{sale}', [SaleController::class, 'destroy'])->name('destroy');
        });

        // Abastecimiento
        Route::prefix('supplies')->name('supplies.')->group(function () {
            Route::get('/', [SupplyController::class, 'index'])->name('index');
            Route::get('/create', [SupplyController::class, 'create'])->name('create');
            Route::post('/store', [SupplyController::class, 'store'])->name('store');
            Route::get('/{supply}', [SupplyController::class, 'show'])->name('show');

            // Solo los administradores pueden eliminar el abastecimiento
            Route::middleware('role:admin')->delete('/{supply}', [SupplyController::class, 'destroy'])->name('destroy');
        });

        // Deudores
        Route::resource('debtors', DebtorController::class);
        Route::post('debtors/pay', [DebtorController::class, 'pay'])->name('debtors.pay');
        Route::post('/debtors/increase', [DebtorController::class, 'increaseDebt'])->name('debtors.increase');
    });

});

require __DIR__.'/auth.php';
