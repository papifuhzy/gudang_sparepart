<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SparepartController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ReportController;

// Notifications
Route::get('/notifications/settings', [NotificationController::class, 'settings'])->name('notifications.settings');
Route::post('/notifications/test-email', [NotificationController::class, 'testEmail'])->name('notifications.test-email');
Route::post('/notifications/send-report', [NotificationController::class, 'sendReport'])->name('notifications.send-report');
Route::post('/notifications/check-low-stock', [NotificationController::class, 'checkLowStock'])->name('notifications.check-low-stock');

// Reports
Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
Route::post('/reports/filter', [ReportController::class, 'filter'])->name('reports.filter');
Route::get('/reports/export-pdf', [ReportController::class, 'exportPdf'])->name('reports.export-pdf');

Route::get('/transactions', [TransactionController::class, 'index'])
    ->name('transactions.index');

Route::post('/transactions', [TransactionController::class, 'store'])
    ->name('transactions.store');


Route::get('/dashboard', [DashboardController::class, 'index'])
    ->name('dashboard');

Route::get('/', function () {
    return redirect('/spareparts');
});

Route::resource('spareparts', SparepartController::class);



