<?php

namespace App\Http\Controllers\RegularUser;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Investment; // Assuming you use Investments for portfolio
use Illuminate\Support\Facades\Auth;

class PortfolioController extends Controller
{
    public function index()
    {
        $user = Auth::guard('regular_user')->user();
        $investments = $user->investments()->with('company')->get();

        return view('regular_user.portfolio.index', compact('investments'));
    }

    public function create()
    {
        // Load companies or other data needed to invest
        return view('regular_user.portfolio.create');
    }

    public function store(Request $request)
    {
        // Validate and save new investment
        $user = Auth::guard('regular_user')->user();

        $validated = $request->validate([
            'company_id' => 'required|exists:companies,id',
            'amount' => 'required|numeric|min:1000',
        ]);

        // Logic to create investment here...

        return redirect()->route('regular_user.portfolio.index')->with('success', 'Investment created successfully.');
    }

    public function edit($id)
    {
        $user = Auth::guard('regular_user')->user();
        $investment = $user->investments()->findOrFail($id);

        return view('regular_user.portfolio.edit', compact('investment'));
    }

    public function update(Request $request, $id)
    {
        $user = Auth::guard('regular_user')->user();
        $investment = $user->investments()->findOrFail($id);

        $validated = $request->validate([
            'amount' => 'required|numeric|min:1000',
        ]);

        // Update logic here...

        return redirect()->route('regular_user.portfolio.index')->with('success', 'Investment updated successfully.');
    }

    public function destroy($id)
    {
        $user = Auth::guard('regular_user')->user();
        $investment = $user->investments()->findOrFail($id);
        $investment->delete();

        return redirect()->route('regular_user.portfolio.index')->with('success', 'Investment deleted.');
    }
}
