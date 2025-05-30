<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SupplyDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'supply_id',
        'quantity'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function supply()
    {
        return $this->belongsTo(Supply::class);
    }
}
