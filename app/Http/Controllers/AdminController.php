<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Investment;
use App\Models\CarCompany;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function users()
    {
        return view('admin.users');
    }

    public function companies()
    {
        return view('admin.companies');
    }

    public function investments()
    {
        return view('admin.investments');
    }

    public function payouts()
    {
        return view('admin.payouts');
    }

    public function fraud()
    {
        return view('admin.fraud');
    }

    public function settings()
    {
        return view('admin.settings');
    }
}
