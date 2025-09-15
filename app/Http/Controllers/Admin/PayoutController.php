<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payout;
use App\Models\RegularUser;
use Illuminate\Http\Request;

class PayoutController extends Controller
{
    public function index(Request $request)
    {
        $query = Payout::with('user');
        
        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        
        // Filter by date range
        if ($request->filled('from_date')) {
            $query->whereDate('created_at', '>=', $request->from_date);
        }
        if ($request->filled('to_date')) {
            $query->whereDate('created_at', '<=', $request->to_date);
        }
        
        $payouts = $query->orderBy('created_at', 'desc')->paginate(30);
        
        $stats = [
            'total' => Payout::count(),
            'pending' => Payout::where('status', 'pending')->count(),
            'paid' => Payout::where('status', 'paid')->count(),
            'failed' => Payout::where('status', 'failed')->count(),
            'total_amount' => Payout::sum('amount'),
            'pending_amount' => Payout::where('status', 'pending')->sum('amount'),
        ];
        
        return view('admin.payouts.index', compact('payouts', 'stats'));
    }

    public function show($id)
    {
        $payout = Payout::with('user')->findOrFail($id);
        return view('admin.payouts.show', compact('payout'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,paid,failed',
            'admin_notes' => 'nullable|string|max:500',
        ]);

        $payout = Payout::findOrFail($id);
        $payout->update([
            'status' => $request->status,
            'admin_notes' => $request->admin_notes,
        ]);

        return back()->with('success', 'Payout status updated successfully.');
    }

    public function bulkUpdate(Request $request)
    {
        $request->validate([
            'payout_ids' => 'required|array',
            'payout_ids.*' => 'exists:payouts,id',
            'status' => 'required|in:pending,paid,failed',
        ]);

        Payout::whereIn('id', $request->payout_ids)
            ->update(['status' => $request->status]);

        return back()->with('success', 'Selected payouts updated successfully.');
    }
}
