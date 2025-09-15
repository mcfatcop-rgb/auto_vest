<?php

namespace App\Http\Controllers\RegularUser;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\SupportMessage;

class HelpController extends Controller
{
    /**
     * Display the help/support page.
     */
    public function index()
    {
        return view('regular_user.help.index');
    }

    /**
     * Handle the submission of the support form.
     */
    public function submit(Request $request)
    {
        $request->validate([
            'subject' => 'required|string|max:255',
            'category' => 'required|string|max:100',
            'message' => 'required|string|min:10',
        ]);

        $user = Auth::guard('regular_user')->user();

        SupportMessage::create([
            'regular_user_id' => $user->id,
            'subject'         => $request->subject,
            'category'        => $request->category,
            'message'         => $request->message,
        ]);

        return back()->with('status', 'Your message has been sent. Our support team will get back to you soon.');
    }
}
