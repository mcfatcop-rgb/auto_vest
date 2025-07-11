<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payout extends Model
{
    protected $fillable = [
        'user_id',
        'amount',
        'payout_date',
        'status', // e.g., pending, paid, failed
    ];

    // A payout belongs to a user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
