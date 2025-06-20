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
use App\Http\Controllers\DeveloperController;

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

    //role
    Route::middleware(['auth', 'role:admin,developer'])->group(function () {
        Route::resource('users', UserController::class);
    });
    Route::middleware(['auth', 'role:agent,admin,developer,user'])->group(function () {
        Route::resource('agents', AgentController::class);
        Route::resource('property_types', PropertyTypeController::class);
    });

    Route::middleware(['auth', 'role:admin,agent,user,developer'])->group(function () {
        Route::get('/agents', [AgentController::class, 'index'])->name('agents.index');
        Route::get('/property_types', [PropertyTypeController::class, 'index'])->name('property_types.index');
    });


    Route::resource('transactions', PropertyTransactionController::class);
    Route::get('transactions/export', [TransactionExportController::class, 'form'])->name('transactions.export.form');
    Route::get('transactions/export/excel', [TransactionExportController::class, 'exportExcel'])->name('transactions.export.excel');
    Route::get('transactions/export/pdf', [TransactionExportController::class, 'exportPDF'])->name('transactions.export.pdf');
    Route::get('/users/export/excel', [UserExportController::class, 'exportExcel'])->name('users.export.excel');
    Route::get('/users/export/pdf', [UserExportController::class, 'exportPDF'])->name('users.export.pdf');
    Route::get('/developer/settings', [DeveloperController::class, 'settings'])->name('developer.settings');
    Route::post('/developer/reset', [DeveloperController::class, 'reset'])->name('developer.reset');


});

require __DIR__.'/auth.php';
