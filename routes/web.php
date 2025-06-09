<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CompaniesController;
use App\Http\Controllers\Api\JobsController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\SalariesController;

Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    // API Routes
    Route::prefix('api')->group(function () {
        Route::apiResource('jobs', JobsController::class);
        Route::apiResource('salaries', SalariesController::class);
        Route::apiResource('users', UserController::class);
    });

    // Web Routes with Inertia
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

    // Companies web routes
    Route::get('/companies', [CompaniesController::class, 'index'])->name('companies.index');
    Route::get('/companies/create', [CompaniesController::class, 'create'])->name('companies.create');
    Route::post('/companies', [CompaniesController::class, 'store'])->name('companies.store');
    Route::get('/companies/{company}', [CompaniesController::class, 'show'])->name('companies.show');
    Route::get('/companies/{company}/edit', [CompaniesController::class, 'edit'])->name('companies.edit');
    Route::put('/companies/{company}', [CompaniesController::class, 'update'])->name('companies.update');
    Route::delete('/companies/{company}', [CompaniesController::class, 'destroy'])->name('companies.destroy');
});

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
