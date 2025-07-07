<?php

namespace App\Http\Controllers\RegularUser;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReferralController extends Controller
{
    public function index()
    {
        $user = Auth::guard('regular_user')->user();

        // You can fetch referral stats here
        $referralLink = route('register') . '?ref=' . $user->id;
        $referralsCount = $user->referrals()->count();
        $referralBonus = $user->referralBonus ?? 0;

        return view('regular_user.referrals.index', compact('referralLink', 'referralsCount', 'referralBonus'));
    }
}
