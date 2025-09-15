<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Investment;
use App\Models\Transaction;
use App\Models\RegularUser;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function earnings(Request $request)
    {
        $query = Transaction::where('status', 'success');
        
        // Filter by date range
        if ($request->filled('from_date')) {
            $query->whereDate('created_at', '>=', $request->from_date);
        }
        if ($request->filled('to_date')) {
            $query->whereDate('created_at', '<=', $request->to_date);
        }
        
        $total = $query->sum('amount');
        $totalCount = $query->count();
        
        // Monthly earnings for chart
        $monthlyEarnings = Transaction::where('status', 'success')
            ->selectRaw('DATE_FORMAT(created_at, "%Y-%m") as month, SUM(amount) as total')
            ->where('created_at', '>=', now()->subMonths(12))
            ->groupBy('month')
            ->orderBy('month')
            ->get();
        
        // Daily earnings for current month
        $dailyEarnings = Transaction::where('status', 'success')
            ->selectRaw('DATE(created_at) as date, SUM(amount) as total')
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->groupBy('date')
            ->orderBy('date')
            ->get();
        
        // Payment methods breakdown
        $methodsBreakdown = Transaction::where('status', 'success')
            ->selectRaw('method, COUNT(*) as count, SUM(amount) as total')
            ->groupBy('method')
            ->get();
        
        // Top users by transaction amount
        $topUsers = Transaction::where('status', 'success')
            ->selectRaw('regular_user_id, SUM(amount) as total, COUNT(*) as count')
            ->with('user')
            ->groupBy('regular_user_id')
            ->orderBy('total', 'desc')
            ->limit(10)
            ->get();
        
        return view('admin.reports.earnings', compact(
            'total', 'totalCount', 'monthlyEarnings', 'dailyEarnings', 
            'methodsBreakdown', 'topUsers'
        ));
    }

    public function investments(Request $request)
    {
        $query = Investment::query();
        
        // Filter by date range
        if ($request->filled('from_date')) {
            $query->whereDate('created_at', '>=', $request->from_date);
        }
        if ($request->filled('to_date')) {
            $query->whereDate('created_at', '<=', $request->to_date);
        }
        
        $totalInvestments = $query->sum('amount');
        $totalCount = $query->count();
        $averageInvestment = $query->avg('amount');

        $byCompany = Investment::select('company_id', DB::raw('SUM(amount) as total, COUNT(*) as count, AVG(amount) as average'))
            ->groupBy('company_id')
            ->with('company')
            ->get();
        
        // Monthly investments for chart
        $monthlyInvestments = Investment::selectRaw('DATE_FORMAT(created_at, "%Y-%m") as month, SUM(amount) as total, COUNT(*) as count')
            ->where('created_at', '>=', now()->subMonths(12))
            ->groupBy('month')
            ->orderBy('month')
            ->get();
        
        // Top investors
        $topInvestors = Investment::selectRaw('regular_user_id, SUM(amount) as total, COUNT(*) as count')
            ->with('user')
            ->groupBy('regular_user_id')
            ->orderBy('total', 'desc')
            ->limit(10)
            ->get();
        
        // Investment trends by company
        $companyTrends = Investment::selectRaw('company_id, DATE_FORMAT(created_at, "%Y-%m") as month, SUM(amount) as total')
            ->with('company')
            ->where('created_at', '>=', now()->subMonths(6))
            ->groupBy('company_id', 'month')
            ->orderBy('month')
            ->get();

        return view('admin.reports.investments', compact(
            'totalInvestments', 'totalCount', 'averageInvestment', 'byCompany',
            'monthlyInvestments', 'topInvestors', 'companyTrends'
        ));
    }
}
