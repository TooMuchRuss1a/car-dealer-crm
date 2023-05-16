<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\EngineController;
use App\Http\Controllers\EquipmentController;
use App\Http\Controllers\GenerationController;
use App\Http\Controllers\ModelController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\SupplyController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {return Inertia::render('Catalog');})->name('catalog');

Route::prefix('/crm')->middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified',])->group(function () {
    Route::get('/', function () {return Inertia::render('CRM/Dashboard');})->name('crm');

    Route::prefix('/countries')->group(function () {
        Route::get('/', [CountryController::class, 'index'])->name('crm.countries.index');
        Route::post('/', [CountryController::class, 'store'])->name('crm.countries.store');
        Route::get('/{id}', [CountryController::class, 'show'])->name('crm.countries.show');
        Route::put('/{id}', [CountryController::class, 'update'])->name('crm.countries.update');
        Route::delete('/{id}', [CountryController::class, 'destroy'])->name('crm.countries.destroy');
    });

    Route::prefix('/brands')->group(function () {
        Route::get('/', [BrandController::class, 'index'])->name('crm.brands.index');
        Route::post('/', [BrandController::class, 'store'])->name('crm.brands.store');
        Route::get('/{id}', [BrandController::class, 'show'])->name('crm.brands.show');
        Route::put('/{id}', [BrandController::class, 'update'])->name('crm.brands.update');
        Route::delete('/{id}', [BrandController::class, 'destroy'])->name('crm.brands.destroy');
    });

    Route::prefix('/models')->group(function () {
        Route::get('/', [ModelController::class, 'index'])->name('crm.models.index');
        Route::post('/', [ModelController::class, 'store'])->name('crm.models.store');
        Route::get('/{id}', [ModelController::class, 'show'])->name('crm.models.show');
        Route::put('/{id}', [ModelController::class, 'update'])->name('crm.models.update');
        Route::delete('/{id}', [ModelController::class, 'destroy'])->name('crm.models.destroy');
    });

    Route::prefix('/engines')->group(function () {
        Route::get('/', [EngineController::class, 'index'])->name('crm.engines.index');
        Route::get('/create', [EngineController::class, 'create'])->name('crm.engines.create');
        Route::post('/', [EngineController::class, 'store'])->name('crm.engines.store');
        Route::get('/{id}', [EngineController::class, 'show'])->name('crm.engines.show');
        Route::get('/{id}/edit', [EngineController::class, 'edit'])->name('crm.engines.edit');
        Route::put('/{id}', [EngineController::class, 'update'])->name('crm.engines.update');
        Route::delete('/{id}', [EngineController::class, 'destroy'])->name('crm.engines.destroy');
    });

    Route::prefix('/generations')->group(function () {
        Route::get('/', [GenerationController::class, 'index'])->name('crm.generations.index');
        Route::get('/create', [GenerationController::class, 'create'])->name('crm.generations.create');
        Route::post('/', [GenerationController::class, 'store'])->name('crm.generations.store');
        Route::get('/{id}', [GenerationController::class, 'show'])->name('crm.generations.show');
        Route::get('/{id}/edit', [GenerationController::class, 'edit'])->name('crm.generations.edit');
        Route::put('/{id}', [GenerationController::class, 'update'])->name('crm.generations.update');
        Route::delete('/{id}', [GenerationController::class, 'destroy'])->name('crm.generations.destroy');
    });

    Route::prefix('/equipments')->group(function () {
        Route::get('/', [EquipmentController::class, 'index'])->name('crm.equipments.index');
        Route::get('/create', [EquipmentController::class, 'create'])->name('crm.equipments.create');
        Route::post('/', [EquipmentController::class, 'store'])->name('crm.equipments.store');
        Route::get('/{id}', [EquipmentController::class, 'show'])->name('crm.equipments.show');
        Route::get('/{id}/edit', [EquipmentController::class, 'edit'])->name('crm.equipments.edit');
        Route::put('/{id}', [EquipmentController::class, 'update'])->name('crm.equipments.update');
        Route::delete('/{id}', [EquipmentController::class, 'destroy'])->name('crm.equipments.destroy');
    });

    Route::prefix('/suppliers')->group(function () {
        Route::get('/', [SupplierController::class, 'index'])->name('crm.suppliers.index');
        Route::post('/', [SupplierController::class, 'store'])->name('crm.suppliers.store');
        Route::get('/{id}', [SupplierController::class, 'show'])->name('crm.suppliers.show');
        Route::put('/{id}', [SupplierController::class, 'update'])->name('crm.suppliers.update');
        Route::delete('/{id}', [SupplierController::class, 'destroy'])->name('crm.suppliers.destroy');
    });

    Route::prefix('/supplies')->group(function () {
        Route::get('/', [SupplyController::class, 'index'])->name('crm.supplies.index');
        Route::get('/create', [SupplyController::class, 'create'])->name('crm.supplies.create');
        Route::post('/', [SupplyController::class, 'store'])->name('crm.supplies.store');
        Route::get('/{id}', [SupplyController::class, 'show'])->name('crm.supplies.show');
        Route::get('/{id}/edit', [SupplyController::class, 'edit'])->name('crm.supplies.edit');
        Route::put('/{id}', [SupplyController::class, 'update'])->name('crm.supplies.update');
        Route::delete('/{id}', [SupplyController::class, 'destroy'])->name('crm.supplies.destroy');
    });
});
