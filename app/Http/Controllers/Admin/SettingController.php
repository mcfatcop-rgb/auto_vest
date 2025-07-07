<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;

class SettingController extends Controller
{
    public function index()
    {
        $settings = Setting::first();
        return view('admin.settings.index', compact('settings'));
    }

    public function save(Request $request)
    {
        $request->validate([
            'mpesa_api_key' => 'required|string',
            'enable_swahili' => 'required|boolean',
        ]);

        $settings = Setting::first();

        if (!$settings) {
            $settings = new Setting();
        }

        $settings->mpesa_api_key = $request->mpesa_api_key;
        $settings->enable_swahili = $request->enable_swahili;
        $settings->save();

        return back()->with('success', 'Settings updated successfully.');
    }


public function settings()
{
    $settings = Setting::first(); // gets the first row in settings table
    return view('admin.settings', compact('settings'));
}

}
