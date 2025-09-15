<?php

namespace App\Http\Controllers\RegularUser;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Transaction;

class BalanceController extends Controller
{
    public function index()
    {
        $user = Auth::guard('regular_user')->user();

        $balance = $user->balance ?? 0;

        // Fetch the 5 most recent transactions (deposit, withdrawal, payout, etc.)
        $transactions = $user->transactions()
            ->latest()
            ->take(5)
            ->get();

        return view('regular_user.balance.index', compact('balance', 'transactions'));
    }
}
