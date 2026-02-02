<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SparepartController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TransactionController;

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


