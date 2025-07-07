<?php

namespace App\Http\Controllers\RegularUser;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class PayoutController extends Controller
{
    public function index()
    {
        $user = Auth::guard('regular_user')->user();
        $payouts = $user->payouts()->orderBy('payout_date', 'desc')->paginate(10);

        return view('regular_user.payouts.index', compact('payouts'));
    }

    public function show($id)
    {
        $user = Auth::guard('regular_user')->user();
        $payout = $user->payouts()->findOrFail($id);

        return view('regular_user.payouts.show', compact('payout'));
    }
}
