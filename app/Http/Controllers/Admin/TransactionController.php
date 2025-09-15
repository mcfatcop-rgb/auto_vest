<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function payments(Request $request)
    {
        $query = Transaction::where('status', 'success')->with('user');
        
        // Filter by date range
        if ($request->filled('from_date')) {
            $query->whereDate('created_at', '>=', $request->from_date);
        }
        if ($request->filled('to_date')) {
            $query->whereDate('created_at', '<=', $request->to_date);
        }
        
        // Filter by method
        if ($request->filled('method')) {
            $query->where('method', $request->method);
        }
        
        $payments = $query->orderBy('created_at', 'desc')->paginate(50);
        
        $stats = [
            'total_amount' => Transaction::where('status', 'success')->sum('amount'),
            'total_count' => Transaction::where('status', 'success')->count(),
            'today_amount' => Transaction::where('status', 'success')
                ->whereDate('created_at', today())->sum('amount'),
            'today_count' => Transaction::where('status', 'success')
                ->whereDate('created_at', today())->count(),
            'methods' => Transaction::where('status', 'success')
                ->selectRaw('method, COUNT(*) as count, SUM(amount) as total')
                ->groupBy('method')
                ->get(),
        ];
        
        return view('admin.transactions.payments', compact('payments', 'stats'));
    }

    public function failed(Request $request)
    {
        $query = Transaction::where('status', 'failed')->with('user');
        
        // Filter by date range
        if ($request->filled('from_date')) {
            $query->whereDate('created_at', '>=', $request->from_date);
        }
        if ($request->filled('to_date')) {
            $query->whereDate('created_at', '<=', $request->to_date);
        }
        
        $failed = $query->orderBy('created_at', 'desc')->paginate(50);
        
        $stats = [
            'total_failed' => Transaction::where('status', 'failed')->count(),
            'total_amount' => Transaction::where('status', 'failed')->sum('amount'),
            'today_failed' => Transaction::where('status', 'failed')
                ->whereDate('created_at', today())->count(),
            'recent_failures' => Transaction::where('status', 'failed')
                ->where('created_at', '>=', now()->subDays(7))->count(),
        ];
        
        return view('admin.transactions.failed', compact('failed', 'stats'));
    }
}
