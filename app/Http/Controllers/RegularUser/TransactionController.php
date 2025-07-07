<?php

namespace App\Http\Controllers\RegularUser;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function index()
    {
        $user = Auth::guard('regular_user')->user();
        $transactions = $user->transactions()->orderBy('transaction_date', 'desc')->paginate(10);

        return view('regular_user.transactions.index', compact('transactions'));
    }

    public function show($id)
    {
        $user = Auth::guard('regular_user')->user();
        $transaction = $user->transactions()->findOrFail($id);

        return view('regular_user.transactions.show', compact('transaction'));
    }
}
