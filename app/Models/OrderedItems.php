<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderedItems extends Model
{
    protected $table = 'ordered_items';

    protected $fillable = [
        'order_id',
        'car_id',
        'order_quantity',
        'user_id',
        'status', // Added status for the OrderDetailsAdmin
        'created_at',
        'updated_at',

    ];

    public $timestamps = true;

    /**
     * Get the order that owns the ordered item.
     */
    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    /**
     * Get the car associated with the ordered item.
     */
    public function car()
    {
        return $this->belongsTo(Cars::class, 'car_id');
    }
}
