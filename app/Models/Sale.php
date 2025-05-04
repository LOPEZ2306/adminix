<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Sale extends Model
{
    use HasFactory;

    protected $fillable = [
        'sale_date',
        'payment_method',
        'total_amount',
        'user_id'
    ];

    protected $casts = [
        'sale_date' => 'datetime',
        'total_amount' => 'decimal:2'
    ];

    /**
     * Relación con el usuario que realizó la venta
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relación con los detalles de la venta
     */
    public function saleDetails()
    {
        return $this->hasMany(SaleDetail::class);
    }
}
