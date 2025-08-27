<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\CustomerRegisterController;
use App\Http\Controllers\Auth\DriverRegisterController;
use App\Http\Controllers\Auth\CustomerLoginController;
use App\Http\Controllers\Auth\DriverLoginController;
use App\Http\Controllers\ServiceRequestController;
use App\Http\Controllers\CustomerDashboardController;

Route::get('/', function () {
    return view('welcome');
});

// Fallback login route for Laravel auth middleware
Route::get('/login', function () {
    return redirect()->route('customer.login.form');
})->name('login');

// Customer registration and login routes
Route::prefix('customer')->group(function () {
    Route::get('/register', function () {
        return view('customer.register');
    })->name('customer.register.form');

    Route::get('/login', function () {
        return view('customer.login');
    })->name('customer.login.form');

    Route::post('/register', [CustomerRegisterController::class, 'register'])->name('customer.register');
    Route::post('/login', [CustomerLoginController::class, 'login'])->name('customer.login');
    Route::post('/logout', [CustomerLoginController::class, 'logout'])->name('customer.logout')->middleware('auth:customer');
});

// Driver registration and login routes
Route::prefix('driver')->group(function () {
    Route::get('/register', function () {
        return view('driver.register');
    })->name('driver.register.form');

    Route::get('/login', function () {
        return view('driver.login');
    })->name('driver.login.form');

    Route::post('/register', [DriverRegisterController::class, 'register'])->name('driver.register');
    Route::post('/login', [DriverLoginController::class, 'login'])->name('driver.login');
    Route::post('/logout', [DriverLoginController::class, 'logout'])->name('driver.logout')->middleware('auth:driver');
});

// Protected routes for authenticated customers
Route::middleware('auth:customer')->group(function () {
    Route::get('/customer/dashboard', [CustomerDashboardController::class, 'index'])->name('customer.dashboard');

    // Existing service request routes
    Route::get('/service-requests/create', [ServiceRequestController::class, 'create'])->name('service_requests.create');
    Route::post('/service-requests', [ServiceRequestController::class, 'store'])->name('service_requests.store');

    // Wait time display route
    Route::get('/service-requests/{id}/wait-time', [ServiceRequestController::class, 'showWaitTime'])->name('service_requests.wait_time');
});
