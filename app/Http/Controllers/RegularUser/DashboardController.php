<?php

namespace App\Http\Controllers\RegularUser;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Investment;
use App\Models\Transaction;
use App\Models\Referral;
use App\Models\Company;
use App\Models\RegularUser;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::guard('regular_user')->user();

        return view('regular_user.dashboard.index', [
            'totalBalance' => $user->balance ?? 0,
            'totalInvested' => $user->investments()->sum('amount') ?? 0,
            'referralsCount' => $user->referrals()->count() ?? 0,
            'recentTransactions' => $user->transactions()->latest()->take(5)->get(),
            'investments' => $user->investments()->with('company')->get(),
        ]);
    }
}
