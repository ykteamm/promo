<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPharmacy extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'pharmacy_id'
    ];
}
