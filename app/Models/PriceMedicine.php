<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PriceMedicine extends Model
{
    use HasFactory;

    protected $fillable = [
        'medicine_id',
        'price_shablon_id',
        'price'
    ];
}
