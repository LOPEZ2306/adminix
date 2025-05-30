<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['product', 'brand', 'quantity', 'price'];

    protected $casts = [
        'quantity' => 'integer',
        'price' => 'decimal:2'
    ];

    public function saleDetails()
    {
        return $this->hasMany(SaleDetail::class);
    }

    public function hasStock($quantity)
    {
        return $this->quantity >= $quantity;
    }

    public function decrementStock($quantity)
    {
        $this->decrement('quantity', $quantity);
    }

    public function incrementStock($quantity)
    {
        $this->increment('quantity', $quantity);
    }
}
