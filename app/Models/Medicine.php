<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medicine extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'category_id',
        'iamge',
    ];

    public function orderProduct()
    {
        return $this->hasMany(OrderProduct::class,'product_id','id');
    }
}
