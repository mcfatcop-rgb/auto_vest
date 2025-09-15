<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Investment extends Model
{
    protected $fillable = [
        'regular_user_id',
        'company_id',
        'amount',
        'shares',
        'investment_date',
    ];

    // An investment belongs to one user
    public function user()
    {
        return $this->belongsTo(RegularUser::class, 'regular_user_id');
    }

    // An investment belongs to one company
    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
