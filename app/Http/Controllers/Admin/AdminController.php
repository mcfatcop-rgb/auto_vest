<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RegularUser;
use App\Models\Investment;
use App\Models\Transaction;
use App\Models\Payout;
use App\Models\FraudLog;
use App\Models\SupportMessage;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        // Date range filtering
        $dateRange = $request->get('date_range', '30'); // Default to last 30 days
        $startDate = now()->subDays($dateRange);
        
        // Basic statistics
        $userCount = RegularUser::count();
        $activeUsers = RegularUser::where('updated_at', '>=', now()->subDays(30))->count();
        $totalInvestment = Investment::sum('amount');
        $totalTransactions = Transaction::where('status', 'success')->sum('amount');
        $pendingPayouts = Payout::where('status', 'pending')->sum('amount');
        $totalCompanies = Company::count();
        
        // Performance metrics
        $successfulTransactions = Transaction::where('status', 'success')->count();
        $failedTransactions = Transaction::where('status', 'failed')->count();
        $totalTransactionCount = $successfulTransactions + $failedTransactions;
        $successRate = $totalTransactionCount > 0 ? round(($successfulTransactions / $totalTransactionCount) * 100, 1) : 0;
        
        $averageInvestment = Investment::avg('amount') ?? 0;
        $averageTransaction = Transaction::where('status', 'success')->avg('amount') ?? 0;
        
        // Recent activity
        $recentUsers = RegularUser::latest()->take(5)->get();
        $recentTransactions = Transaction::with('user')->latest()->take(5)->get();
        $recentInvestments = Investment::with(['user', 'company'])->latest()->take(5)->get();
        
        // Alerts and notifications
        $fraudAlerts = FraudLog::where('status', 'pending')->count();
        $unreadSupport = SupportMessage::where('admin_read', false)->count();
        $failedTransactionsCount = Transaction::where('status', 'failed')->count();
        
        // High-value transactions (above 100,000)
        $highValueTransactions = Transaction::where('amount', '>', 100000)
            ->where('created_at', '>=', now()->subDays(7))
            ->count();
        
        // Company performance
        $companyStats = Company::withCount('investments')
            ->withSum('investments', 'amount')
            ->withAvg('investments', 'amount')
            ->get();
        
        // Top performing companies
        $topCompanies = Company::withCount('investments')
            ->withSum('investments', 'amount')
            ->orderBy('investments_sum_amount', 'desc')
            ->take(5)
            ->get();
        
        // Monthly trends (last 6 months)
        $monthlyStats = [
            'users' => RegularUser::selectRaw('DATE_FORMAT(created_at, "%Y-%m") as month, COUNT(*) as count')
                ->where('created_at', '>=', now()->subMonths(6))
                ->groupBy('month')
                ->orderBy('month')
                ->get(),
            'investments' => Investment::selectRaw('DATE_FORMAT(created_at, "%Y-%m") as month, SUM(amount) as total, COUNT(*) as count')
                ->where('created_at', '>=', now()->subMonths(6))
                ->groupBy('month')
                ->orderBy('month')
                ->get(),
            'transactions' => Transaction::selectRaw('DATE_FORMAT(created_at, "%Y-%m") as month, SUM(amount) as total, COUNT(*) as count')
                ->where('status', 'success')
                ->where('created_at', '>=', now()->subMonths(6))
                ->groupBy('month')
                ->orderBy('month')
                ->get(),
        ];
        
        // Daily stats for the selected period
        $dailyStats = [
            'investments' => Investment::selectRaw('DATE(created_at) as date, SUM(amount) as total, COUNT(*) as count')
                ->where('created_at', '>=', $startDate)
                ->groupBy('date')
                ->orderBy('date')
                ->get(),
            'transactions' => Transaction::selectRaw('DATE(created_at) as date, SUM(amount) as total, COUNT(*) as count')
                ->where('status', 'success')
                ->where('created_at', '>=', $startDate)
                ->groupBy('date')
                ->orderBy('date')
                ->get(),
        ];
        
        // Referral statistics
        $referralStats = [
            'total_referrals' => \App\Models\Referral::count(),
            'active_referrers' => \App\Models\Referral::distinct('referrer_id')->count(),
        ];

        return view('admin.dashboard.index', compact(
            'userCount', 'activeUsers', 'totalInvestment', 'totalTransactions', 'pendingPayouts',
            'totalCompanies', 'successRate', 'averageInvestment', 'averageTransaction',
            'recentUsers', 'recentTransactions', 'recentInvestments',
            'fraudAlerts', 'unreadSupport', 'failedTransactionsCount', 'highValueTransactions',
            'companyStats', 'topCompanies', 'monthlyStats', 'dailyStats', 'referralStats',
            'dateRange'
        ));
    }
}
