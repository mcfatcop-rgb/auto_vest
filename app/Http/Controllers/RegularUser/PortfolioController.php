<?php

namespace App\Http\Controllers\RegularUser;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Investment;
use App\Models\Company;

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
        $companies = Company::all(); // Fetch all available companies
        return view('regular_user.portfolio.create', compact('companies'));
    }

    public function store(Request $request)
    {
        $user = Auth::guard('regular_user')->user();

        $validated = $request->validate([
            'company_id' => 'required|exists:companies,id',
            'amount' => 'required|numeric|min:1000',
                'investment_date' => now(),

        ]);

        $investment = new Investment();
        $investment->regular_user_id = $user->id; // Fix this line
        $investment->company_id = $validated['company_id'];
        $investment->amount = $validated['amount'];
        $investment->save();

        return redirect()->route('regular_user.portfolio.index')->with('success', 'Investment created successfully.');
    }

    public function edit($id)
    {
        $user = Auth::guard('regular_user')->user();
        $investment = $user->investments()->findOrFail($id);
        $companies = Company::all(); // In case you want to allow changing company
        return view('regular_user.portfolio.edit', compact('investment', 'companies'));
    }

    public function update(Request $request, $id)
    {
        $user = Auth::guard('regular_user')->user();
        $investment = $user->investments()->findOrFail($id);

        $validated = $request->validate([
            'amount' => 'required|numeric|min:1000',
        ]);

        $investment->amount = $validated['amount'];
        $investment->save();

        return redirect()->route('regular_user.portfolio.index')->with('success', 'Investment updated successfully.');
    }

    public function destroy($id)
    {
        $user = Auth::guard('regular_user')->user();
        $investment = $user->investments()->findOrFail($id);
        $investment->delete();

        return redirect()->route('regular_user.portfolio.index')->with('success', 'Investment deleted successfully.');
    }
}
