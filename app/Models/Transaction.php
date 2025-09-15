<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'regular_user_id',
        'transaction_type', // e.g., payment, withdrawal
        'amount',
        'status', // success, failed, pending
        'transaction_date',
        'reference',
        'method', // e.g., mpesa, bank
    ];

    // A transaction belongs to a user
    public function user()
    {
        return $this->belongsTo(RegularUser::class, 'regular_user_id');
    }
}
