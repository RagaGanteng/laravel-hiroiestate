<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PropertyTypeController;
use App\Http\Controllers\FacilityController;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserExportController;
use App\Http\Controllers\PropertyTransactionController;
use App\Http\Controllers\TransactionExportController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Master Data
    Route::resource('property-types', PropertyTypeController::class);
    Route::resource('facilities', FacilityController::class);
    Route::resource('agents', AgentController::class);
    Route::resource('users', UserController::class);

    Route::resource('transactions', PropertyTransactionController::class);
    Route::get('transactions/export', [TransactionExportController::class, 'form'])->name('transactions.export.form');
    Route::get('transactions/export/excel', [TransactionExportController::class, 'exportExcel'])->name('transactions.export.excel');
    Route::get('transactions/export/pdf', [TransactionExportController::class, 'exportPDF'])->name('transactions.export.pdf');
    Route::get('/users/export/excel', [UserExportController::class, 'exportExcel'])->name('users.export.excel');
    Route::get('/users/export/pdf', [UserExportController::class, 'exportPDF'])->name('users.export.pdf');

});

require __DIR__.'/auth.php';
