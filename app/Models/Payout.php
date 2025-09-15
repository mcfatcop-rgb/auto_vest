<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payout extends Model
{
    protected $fillable = [
        'regular_user_id',
        'amount',
        'payout_date',
        'status', // e.g., pending, paid, failed
        'admin_notes',
    ];

    // A payout belongs to a user
    public function user()
    {
        return $this->belongsTo(RegularUser::class, 'regular_user_id');
    }
}
