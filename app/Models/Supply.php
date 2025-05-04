<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Supply extends Model
{
    use HasFactory;

    protected $fillable = [
        'supply_date',
        'total_amount',
        'user_id'
    ];

    protected $casts = [
        'supply_date' => 'datetime',
        'total_amount' => 'decimal:2'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function supplyDetails()
    {
        return $this->hasMany(SupplyDetail::class);
    }
}
