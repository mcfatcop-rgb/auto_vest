<?php

namespace App\Http\Controllers\RegularUser;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // You can load summary stats here (portfolio value, balance, etc.)
        return view('regular_user.dashboard.index');
    }
}
