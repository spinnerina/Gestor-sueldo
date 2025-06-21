<?php

use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\JobsController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\RoleUserController;
use App\Http\Controllers\Api\SalariesController;
use App\Http\Controllers\Api\CompaniesController;

Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    // API Routes
    Route::prefix('api')->group(function () {
        Route::apiResource('jobs', JobsController::class);
        Route::apiResource('salaries', SalariesController::class);
        Route::apiResource('users', UserController::class);
        Route::apiResource('roleUser', RoleUserController::class);
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


    // Role User web routes
    Route::get('/roleUser', [RoleUserController::class, 'index'])->name('roleUser.index')->middleware('role:admin');
    Route::delete('/roleUser/{user_id}/{role_id}', [RoleUserController::class, 'destroy'])->name('roleUser.destroy')->middleware('role:admin');
});

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
