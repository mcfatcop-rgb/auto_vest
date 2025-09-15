<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FraudLog extends Model
{
    protected $fillable = [
        'regular_user_id',
        'reason',
        'status', // pending, reviewed, resolved
        'admin_notes',
    ];

    // A fraud log belongs to a user
    public function user()
    {
        return $this->belongsTo(RegularUser::class, 'regular_user_id');
    }
}
