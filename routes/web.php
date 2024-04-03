<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Middleware\Guest;
use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware([Guest::class])->group(function () {
    Route::prefix('/login')->name('login')->group(function () {
        Route::get('/', [HomeController::class, 'loginIndex']);
        Route::post('/', [HomeController::class, 'login']);
    });
    
    Route::prefix('/register')->name('register')->group(function () {
        Route::get('/', [HomeController::class, 'registerIndex']);
        Route::post('/', [HomeController::class, 'register']);
    });
});

Route::middleware([Authenticate::class])->group(function () {
    Route::get('/logout', [HomeController::class, 'logout'])->name('logout');
    
    Route::prefix('/dashboard')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
        Route::post('/get-tasks', [DashboardController::class, 'tasks'])->name('dashboard.get-tasks');
        Route::post('/save-task', [DashboardController::class, 'saveTask'])->name('dashboard.save-task');
        Route::post('/delete-task', [DashboardController::class, 'deleteTask'])->name('dashboard.delete-task');
        Route::post('/update-status-task', [DashboardController::class, 'updateStatusTask'])->name('dashboard.update-status-task');
    });
});
