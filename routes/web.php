<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Admin\StationController;
use App\Http\Controllers\Admin\TrainController;
use App\Http\Controllers\Admin\ScheduleController;
use App\Http\Controllers\Admin\PricingController;
use App\Http\Controllers\Admin\TicketController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Manager\DashboardController as ManagerDashboard;
use App\Http\Controllers\Manager\ReportController;
use App\Http\Middleware\CheckRole;

// Auth
Route::get('/', fn() => redirect()->route('login'));
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Admin Routes
Route::prefix('admin')->middleware(CheckRole::class . ':admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboard::class, 'index'])->name('dashboard');

    Route::resource('stations', StationController::class)->except('show');
    Route::resource('trains', TrainController::class)->except('show');
    Route::resource('schedules', ScheduleController::class)->except('show');
    Route::resource('pricing', PricingController::class)->except('show');

    Route::get('/tickets', [TicketController::class, 'index'])->name('tickets.index');
    Route::get('/tickets/{ticket}', [TicketController::class, 'show'])->name('tickets.show');
    Route::post('/tickets/{ticket}/status', [TicketController::class, 'updateStatus'])->name('tickets.updateStatus');

    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/{id}', [UserController::class, 'show'])->name('users.show');
});

// Manager Routes
Route::prefix('manager')->middleware(CheckRole::class . ':manager')->name('manager.')->group(function () {
    Route::get('/dashboard', [ManagerDashboard::class, 'index'])->name('dashboard');
    Route::get('/reports/sales', [ReportController::class, 'sales'])->name('reports.sales');
    Route::get('/reports/passengers', [ReportController::class, 'passengers'])->name('reports.passengers');
});
