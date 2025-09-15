<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class RegularUser extends Authenticatable
{
    use Notifiable;

    protected $guard = 'regular_user';

    protected $fillable = [
        'name',
        'phone',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Relationship: Events this user has booked.
     */
    public function bookedEvents()
    {
        return $this->belongsToMany(Event::class, 'event_user', 'user_id', 'event_id')
                    ->withTimestamps();
    }

    /**
     * Relationship: Investments by this user.
     */

    /**
     * Relationship: Transactions made by this user.
     */
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    /**
     * Relationship: Payouts to this user.
     */
public function payouts()
{
    return $this->hasMany(Payout::class, 'user_id');
}

    /**
     * Relationship: Referrals made by this user.
     */
    public function referrals()
    {
        return $this->hasMany(Referral::class, 'referrer_id');
    }

    /**
     * Send password reset notifications.
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new \App\Notifications\RegularUserResetPasswordNotification($token));
    }

public function investments()
{
    return $this->hasMany(Investment::class, 'regular_user_id');
}

}
