<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Debtor extends Model
{
    protected $fillable = [
        'full_name',
        'cedula',
        'residencia',
        'deuda',
    ];

}
