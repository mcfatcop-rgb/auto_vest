<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payout;

class PayoutController extends Controller
{
    public function index()
    {
        $payouts = Payout::with('user')->orderBy('created_at', 'desc')->paginate(30);
        return view('admin.payouts.index', compact('payouts'));
    }
}
