<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SaleDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'sale_id',
        'product_id',
        'quantity',
        'price',
        'discount',
        'subtotal'
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'discount' => 'decimal:2',
        'subtotal' => 'decimal:2'
    ];

    /**
     * Relación con la venta
     */
    public function sale()
    {
        return $this->belongsTo(Sale::class);
    }

    /**
     * Relación con el producto
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Calcular el subtotal
     */
    public function calculateSubtotal()
    {
        return ($this->price * $this->quantity) - $this->discount;
    }

    /**
     * Establecer el subtotal automáticamente
     */
    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (!$model->subtotal) {
                $model->subtotal = ($model->price * $model->quantity) - $model->discount;
            }
        });

        static::updating(function ($model) {
            $model->subtotal = ($model->price * $model->quantity) - $model->discount;
        });
    }
}
