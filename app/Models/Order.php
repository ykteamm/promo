<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'status',
        'order_price',
        'promo_price',
        'money_arrival',
        'delivery_date',
        'close',
        'number',
    ];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function orderProduct()
    {
        return $this->hasMany(OrderProduct::class,'order_id','id');
    }
}
