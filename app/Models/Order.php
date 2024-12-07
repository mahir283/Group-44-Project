<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';

    protected $fillable = [
        'user_id',
        'cardname',
        'cardnumber',
        'expire_month',
        'expire_year',
        'cvv',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}

