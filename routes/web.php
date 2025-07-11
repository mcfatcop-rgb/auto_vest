<?php

use Illuminate\Support\Facades\Route;

// Admin Controllers
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CompanyController;
use App\Http\Controllers\Admin\PayoutController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\TransactionController;
use App\Http\Controllers\Admin\UserController;

// Regular User Controllers
use App\Http\Controllers\RegularUser\BalanceController;
use App\Http\Controllers\RegularUser\DashboardController;
use App\Http\Controllers\RegularUser\HelpController;
use App\Http\Controllers\RegularUser\PayoutController as RegularPayoutController;
use App\Http\Controllers\RegularUser\PortfolioController;
use App\Http\Controllers\RegularUser\ReferralController;
use App\Http\Controllers\RegularUser\SettingsController as RegularSettingsController;
use App\Http\Controllers\RegularUser\TransactionController as RegularTransactionController;


/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

/*
|--------------------------------------------------------------------------
| Authenticated User Profile Routes
|--------------------------------------------------------------------------
*/


/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {

    // Admin Dashboard & Logout
    Route::get('dashboard', [AdminController::class, 'index'])->name('dashboard');
    Route::post('logout', [AdminAuthController::class, 'logout'])->name('logout');

    // Companies
    Route::resource('companies', CompanyController::class);
    Route::post('companies/{id}/update-stock', [CompanyController::class, 'updateStock'])->name('companies.updateStock');

    // Users and Referrals
    Route::get('users', [UserController::class, 'index'])->name('users.index');
    Route::get('users/{id}/referrals', [UserController::class, 'referrals'])->name('users.referrals');

    // Payouts and Transactions
    Route::get('payouts', [PayoutController::class, 'index'])->name('payouts.index');
    Route::get('payments', [TransactionController::class, 'payments'])->name('payments');
    Route::get('failed-transactions', [TransactionController::class, 'failed'])->name('transactions.failed');

    // Reports
    Route::prefix('reports')->name('reports.')->group(function () {
        Route::get('earnings', [ReportController::class, 'earnings'])->name('earnings');
        Route::get('investments', [ReportController::class, 'investments'])->name('investments');
    });

    // Settings
    Route::get('settings', [SettingController::class, 'index'])->name('settings');
    Route::post('settings/save', [SettingController::class, 'save'])->name('settings.save');
});

/*
|--------------------------------------------------------------------------
| Regular User Routes
|--------------------------------------------------------------------------
*/

Route::prefix('regular_user')->middleware(['auth:regular_user'])->name('regular_user.')->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Portfolio CRUD
    Route::resource('portfolio', PortfolioController::class);

    // Balance
    Route::get('balance', [BalanceController::class, 'index'])->name('balance');

    // Transactions (index, show only)
    Route::resource('transactions', RegularTransactionController::class)->only(['index', 'show']);

    // Payouts (index, show only)
    Route::resource('payouts', RegularPayoutController::class)->only(['index', 'show']);

    // Referrals
    Route::get('referrals', [ReferralController::class, 'index'])->name('referrals');

    // Settings (view & update)
    Route::get('settings', [RegularSettingsController::class, 'index'])->name('settings');
    Route::post('settings/update', [RegularSettingsController::class, 'update'])->name('settings.update');

    // Help
    Route::get('help', [HelpController::class, 'index'])->name('help');
});

require __DIR__.'/auth.php';
