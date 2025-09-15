<?php

namespace App\Http\Controllers\RegularUser\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('regular_user.auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required|string',
        ]);

        if (Auth::guard('regular_user')->attempt($credentials, $request->remember)) {
            return redirect()->intended(route('regular_user.dashboard'));
        }

        return back()->withErrors(['email' => 'Invalid credentials.'])->withInput();
    }

    public function logout(Request $request)
    {
        Auth::guard('regular_user')->logout();
        return redirect()->route('regular_user.login');
    }
}
