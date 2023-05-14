<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoryMoneyArrival extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'money',
        'add_date'
    ];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }
}
