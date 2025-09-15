<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        'mpesa_api_key',
        'enable_swahili',
        'roi_multiplier',
        'next_payout',
        'site_name',
        'site_email',
        'site_phone',
        'site_description',
        'min_investment',
        'max_investment',
        'payout_frequency_days',
        'maintenance_mode',
        'maintenance_message',
    ];

    protected $casts = [
        'enable_swahili' => 'boolean',
        'roi_multiplier' => 'decimal:2',
        'min_investment' => 'decimal:2',
        'max_investment' => 'decimal:2',
        'payout_frequency_days' => 'integer',
        'maintenance_mode' => 'boolean',
        'next_payout' => 'date',
    ];

    public $timestamps = true; // Enable timestamps for audit trail
}
