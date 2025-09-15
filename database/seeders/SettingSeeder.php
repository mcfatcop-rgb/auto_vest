<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Setting::create([
            'site_name' => 'AutoVest',
            'site_email' => 'admin@autovest.com',
            'site_phone' => '+254 700 000 000',
            'site_description' => 'Your trusted investment platform for car company investments',
            'enable_swahili' => false,
            'roi_multiplier' => 1.00,
            'min_investment' => 100.00,
            'max_investment' => 100000.00,
            'payout_frequency_days' => 30,
            'next_payout' => now()->addDays(30),
            'mpesa_api_key' => null,
            'maintenance_mode' => false,
            'maintenance_message' => 'We are currently performing scheduled maintenance. Please check back later.',
        ]);
    }
}