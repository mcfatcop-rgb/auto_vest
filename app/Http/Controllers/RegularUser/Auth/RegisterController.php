<?php

namespace App\Http\Controllers\RegularUser\Auth;

use App\Http\Controllers\Controller;
use App\Models\RegularUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('regular_user.auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'phone'    => 'required|string|max:15|unique:regular_users',
            'email'    => 'required|email|unique:regular_users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = RegularUser::create([
            'name'     => $request->name,
            'phone'    => $request->phone,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
        ]);

        Auth::guard('regular_user')->login($user);

        return redirect()->route('regular_user.dashboard');
    }
}
