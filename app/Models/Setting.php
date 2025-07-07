<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        'mpesa_api_key',
        'enable_swahili',
        // Add other settings fields as needed
    ];

    public $timestamps = false; // Usually settings table does not need timestamps
}
