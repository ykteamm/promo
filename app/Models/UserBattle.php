<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserBattle extends Model
{
    use HasFactory;

    protected $fillable = [
        'u1id',
        'u2id',
        'money1',
        'money2',
        'win',
        'lose',
        'promo_ball1',
        'promo_ball2',
        'start_day',
        'end_day',
        'ends',
    ];

    public function u1ids()
    {
        return $this->belongsTo(User::class,'u1id','id');
    }
    public function u2ids()
    {
        return $this->belongsTo(User::class,'u2id','id');
    }
}
