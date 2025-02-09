<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';

    protected $fillable = [
        'cardname',
        'cardnumber',
        'expire_month',
        'expire_year',
        'cvv',
        'user_id',
    ];


    public $timestamps = false;

    /**
     * Get the user that owns the order.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Get the ordered items associated with the order.
     */
    public function orderedItems()
    {
        return $this->hasMany(OrderedItems::class, 'order_id');  // Use OrderedItems class
    }


}
