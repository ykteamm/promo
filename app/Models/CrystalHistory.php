<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CrystalHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'crystal',
        'comment',
    ];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }
}
