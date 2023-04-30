<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\CountryController;
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
});
