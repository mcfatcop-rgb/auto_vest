<?php

namespace App\Http\Controllers\RegularUser;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Referral;

class ReferralController extends Controller
{
    public function index()
    {
        $user = Auth::guard('regular_user')->user();

        // Build referral link using referral code or user ID
        $referralCode = $user->referral_code ?? $user->id;
        $referralLink = route('register') . '?ref=' . $referralCode;

        // Fetch referred users
        $referrals = $user->referrals()->get();

        // Calculate stats
        $referralsCount = $referrals->count();
        $referralBonus = $referrals->sum('referral_bonus');
        $pendingBonus = $referrals->where('bonus_paid', false)->sum('referral_bonus');

        return view('regular_user.referrals.index', compact(
            'referralLink',
            'referralsCount',
            'referralBonus',
            'pendingBonus',
            'referrals'
        ));
    }
}
