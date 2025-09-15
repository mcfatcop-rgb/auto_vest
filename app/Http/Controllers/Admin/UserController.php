<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RegularUser;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = RegularUser::query();
        
        // Search functionality
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }
        
        // Filter by balance range
        if ($request->filled('min_balance')) {
            $query->where('balance', '>=', $request->min_balance);
        }
        if ($request->filled('max_balance')) {
            $query->where('balance', '<=', $request->max_balance);
        }
        
        $users = $query->orderBy('created_at', 'desc')->paginate(25);
        
        return view('admin.users.index', compact('users'));
    }

    public function show($id)
    {
        $user = RegularUser::with(['investments.company', 'transactions', 'payouts'])->findOrFail($id);
        return view('admin.users.show', compact('user'));
    }

    public function referrals($id)
    {
        $user = RegularUser::findOrFail($id);
        $referrals = $user->referrals; // Assuming RegularUser model has referrals relationship
        return view('admin.users.referrals', compact('user', 'referrals'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:active,suspended',
        ]);

        $user = RegularUser::findOrFail($id);
        $user->update(['status' => $request->status]);

        return back()->with('success', 'User status updated successfully.');
    }
}
