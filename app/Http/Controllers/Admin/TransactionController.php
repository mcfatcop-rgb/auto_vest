<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;

class TransactionController extends Controller
{
    public function payments()
    {
        $payments = Transaction::where('status', 'success')->with('user')->orderBy('created_at', 'desc')->paginate(50);
        return view('admin.transactions.payments', compact('payments'));
    }

    public function failed()
    {
        $failed = Transaction::where('status', 'failed')->with('user')->orderBy('created_at', 'desc')->paginate(50);
        return view('admin.transactions.failed', compact('failed'));
    }
}
