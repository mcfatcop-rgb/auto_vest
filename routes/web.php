<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\AdminController;



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
});


Route::prefix('admin')->middleware(['auth',])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/users', [AdminController::class, 'users'])->name('admin.users');
    Route::get('/companies', [AdminController::class, 'companies'])->name('admin.companies');
    Route::get('/investments', [AdminController::class, 'investments'])->name('admin.investments');
    Route::get('/payouts', [AdminController::class, 'payouts'])->name('admin.payouts');
    Route::get('/fraud', [AdminController::class, 'fraud'])->name('admin.fraud');
    Route::get('/settings', [AdminController::class, 'settings'])->name('admin.settings');
});


require __DIR__.'/auth.php';
