<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
        'device_id',
        'referred_by', // User who referred this user, nullable
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    // One user has many investments
    public function investments()
    {
        return $this->hasMany(Investment::class);
    }

    // One user has many payouts
    public function payouts()
    {
        return $this->hasMany(Payout::class);
    }

    // One user has many transactions (payments)
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    // Referrals - users this user referred
    public function referrals()
    {
        return $this->hasMany(User::class, 'referred_by');
    }

    // The user who referred this user
    public function referrer()
    {
        return $this->belongsTo(User::class, 'referred_by');
    }
}
