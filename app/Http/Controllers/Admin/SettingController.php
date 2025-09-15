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
            'mpesa_api_key' => 'nullable|string|max:255',
            'enable_swahili' => 'required|boolean',
            'roi_multiplier' => 'required|numeric|min:0.01|max:10.00',
            'next_payout' => 'nullable|date|after:today',
            'site_name' => 'required|string|max:255',
            'site_email' => 'nullable|email|max:255',
            'site_phone' => 'nullable|string|max:20',
            'site_description' => 'nullable|string|max:1000',
            'min_investment' => 'required|numeric|min:1|max:1000000',
            'max_investment' => 'required|numeric|min:1|max:10000000',
            'payout_frequency_days' => 'required|integer|min:1|max:365',
            'maintenance_mode' => 'required|boolean',
            'maintenance_message' => 'nullable|string|max:1000',
        ]);

        $settings = Setting::first();

        if (!$settings) {
            $settings = new Setting();
        }

        $settings->fill($request->all());
        $settings->save();

        return back()->with('success', 'Settings updated successfully.');
    }
}
