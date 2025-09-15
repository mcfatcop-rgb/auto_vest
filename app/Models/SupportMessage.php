<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupportMessage extends Model
{
    use HasFactory;

    protected $fillable = [
        'regular_user_id',
        'subject',
        'category',
        'message',
        'admin_response',
        'status',
        'admin_read',
    ];

    public function user()
    {
        return $this->belongsTo(RegularUser::class, 'regular_user_id');
    }
}
