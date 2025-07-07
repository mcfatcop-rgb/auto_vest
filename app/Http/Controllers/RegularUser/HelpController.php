<?php

namespace App\Http\Controllers\RegularUser;

use App\Http\Controllers\Controller;

class HelpController extends Controller
{
    public function index()
    {
        return view('regular_user.help.index');
    }
}
