<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderedItems extends Model
{
    protected $table = 'ordered_items';

    protected $fillable = [
        'id',
        'order_id',
        'car_id',
        'order_quantity',
        'user_id',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    public function car()
    {
        return $this->belongsTo(Cars::class, 'car_id');
    }
}
