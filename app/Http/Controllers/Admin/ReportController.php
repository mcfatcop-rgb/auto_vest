<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Investment;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function earnings()
    {
        $total = Transaction::where('status', 'success')->sum('amount');
        // Add chart data logic here if needed
        return view('admin.reports.earnings', compact('total'));
    }

    public function investments()
    {
        $totalInvestments = Investment::sum('amount');

        $byCompany = Investment::select('company_id', DB::raw('SUM(amount) as total'))
            ->groupBy('company_id')
            ->with('company')
            ->get();

        return view('admin.reports.investments', compact('totalInvestments', 'byCompany'));
    }
}
