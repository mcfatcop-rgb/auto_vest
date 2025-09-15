<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FraudLog;
use App\Models\RegularUser;
use Illuminate\Http\Request;

class FraudController extends Controller
{
    public function index()
    {
        $fraudLogs = FraudLog::with('user')
            ->orderBy('created_at', 'desc')
            ->paginate(20);
        
        $stats = [
            'total' => FraudLog::count(),
            'pending' => FraudLog::where('status', 'pending')->count(),
            'reviewed' => FraudLog::where('status', 'reviewed')->count(),
            'resolved' => FraudLog::where('status', 'resolved')->count(),
        ];

        return view('admin.fraud.index', compact('fraudLogs', 'stats'));
    }

    public function show($id)
    {
        $fraudLog = FraudLog::with('user')->findOrFail($id);
        return view('admin.fraud.show', compact('fraudLog'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,reviewed,resolved',
            'admin_notes' => 'nullable|string|max:1000',
        ]);

        $fraudLog = FraudLog::findOrFail($id);
        $fraudLog->update([
            'status' => $request->status,
            'admin_notes' => $request->admin_notes,
        ]);

        return back()->with('success', 'Fraud log updated successfully.');
    }

    public function create()
    {
        $users = RegularUser::orderBy('name')->get();
        return view('admin.fraud.create', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'regular_user_id' => 'required|exists:regular_users,id',
            'reason' => 'required|string|max:1000',
        ]);

        FraudLog::create([
            'regular_user_id' => $request->regular_user_id,
            'reason' => $request->reason,
            'status' => 'pending',
        ]);

        return redirect()->route('admin.fraud.index')->with('success', 'Fraud log created successfully.');
    }
}

