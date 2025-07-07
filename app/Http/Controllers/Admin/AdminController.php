<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Investment;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $userCount = User::count();
        $totalInvestment = Investment::sum('amount');

        return view('admin.dashboard.index', compact('userCount', 'totalInvestment'));
    }
}
