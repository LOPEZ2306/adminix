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

    /**
     * Relación con los detalles de venta
     */
    public function saleDetails()
    {
        return $this->hasMany(SaleDetail::class);
    }

    /**
     * Verificar si hay suficiente stock disponible
     */
    public function hasStock($quantity)
    {
        return $this->quantity >= $quantity;
    }

    /**
     * Reducir el stock del producto
     */
    public function decrementStock($quantity)
    {
        $this->decrement('quantity', $quantity);
    }

    /**
     * Incrementar el stock del producto
     */
    public function incrementStock($quantity)
    {
        $this->increment('quantity', $quantity);
    }
}
