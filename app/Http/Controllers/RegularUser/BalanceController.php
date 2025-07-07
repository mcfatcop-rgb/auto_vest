<?php

namespace App\Http\Controllers\RegularUser;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BalanceController extends Controller
{
    public function index()
    {
        $user = Auth::guard('regular_user')->user();

        // Assume balance is a property or relation
        $balance = $user->balance ?? 0;

        return view('regular_user.balance.index', compact('balance'));
    }
}
