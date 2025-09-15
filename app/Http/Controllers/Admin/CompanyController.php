<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Investment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CompanyController extends Controller
{
    public function index()
    {
        $companies = Company::withCount('investments')
            ->withSum('investments', 'amount')
            ->withAvg('investments', 'amount')
            ->get();
        
        $stats = [
            'total_companies' => Company::count(),
            'total_investments' => Investment::count(),
            'total_investment_amount' => Investment::sum('amount'),
            'average_investment' => Investment::avg('amount'),
        ];
        
        return view('admin.companies.index', compact('companies', 'stats'));
    }

    public function create()
    {
        return view('admin.companies.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'logo' => 'required|image',
            'stock_price' => 'required|numeric|min:1',
        ]);

        $path = $request->file('logo')->store('logos', 'public');

        Company::create([
            'name' => $request->name,
            'logo' => $path,
            'stock_price' => $request->stock_price,
        ]);

        return redirect()->route('admin.companies.index')->with('success', 'Company added successfully.');
    }

    public function edit($id)
    {
        $company = Company::findOrFail($id);
        return view('admin.companies.edit', compact('company'));
    }

    public function update(Request $request, $id)
    {
        $company = Company::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'logo' => 'nullable|image',
            'stock_price' => 'required|numeric|min:1',
        ]);

        if ($request->hasFile('logo')) {
            // Delete old logo
            if ($company->logo) {
                Storage::disk('public')->delete($company->logo);
            }
            $path = $request->file('logo')->store('logos', 'public');
            $company->logo = $path;
        }

        $company->name = $request->name;
        $company->stock_price = $request->stock_price;
        $company->save();

        return redirect()->route('admin.companies.index')->with('success', 'Company updated successfully.');
    }
}
