<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\CarCompany;
use App\Models\Investment;
use App\Models\Payout;
use App\Models\FraudLog;

class AdminController extends Controller
{
    /**
     * GET /admin/dashboard
     */
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    /**
     * GET /admin/users
     */
    public function users()
    {
        // You can switch to simplePaginate() if you prefer
        $users = User::latest()->paginate(20);

        return view('admin.users', compact('users'));
    }

    /**
     * GET /admin/companies
     */
    public function companies()
    {
        $companies = CarCompany::latest()->paginate(20);

        return view('admin.companies', compact('companies'));
    }

    /**
     * GET /admin/investments
     */
    public function investments()
    {
        $investments = Investment::with(['user', 'company'])
            ->latest()
            ->paginate(20);

        return view('admin.investments', compact('investments'));
    }

    /**
     * GET /admin/payouts
     */
    public function payouts()
    {
        $payouts = Payout::with('user')
            ->orderByDesc('created_at')
            ->paginate(20);

        return view('admin.payouts', compact('payouts'));
    }

    /**
     * GET /admin/fraud
     */
    public function fraud()
    {
        $logs = FraudLog::with('user')
            ->orderByDesc('created_at')
            ->paginate(20);

        return view('admin.fraud', compact('logs'));
    }

    /**
     * GET /admin/settings
     * Delegates to SettingsController for POST/PUT
     */
    public function settings()
    {
        // Pull settings into an object for easy access in the view
        $settings = \App\Models\Setting::pluck('value', 'key');

        return view('admin.settings', ['settings' => (object) $settings]);
    }
}
