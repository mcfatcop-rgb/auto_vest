<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = [
        'name',
        'logo',
        'stock_price',
    ];

    // One company has many investments
    public function investments()
    {
        return $this->hasMany(Investment::class);
    }
}
