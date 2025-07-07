<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::paginate(25);
        return view('admin.users.index', compact('users'));
    }

    public function referrals($id)
    {
        $user = User::findOrFail($id);
        $referrals = $user->referrals; // Assuming User model has referrals relationship
        return view('admin.users.referrals', compact('user', 'referrals'));
    }
}
