<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Basket extends Model
{
    use HasFactory;

    // Table associated with the 'basket' model
    protected $table = 'baskets';

    // The attributes that can be mass-assigned
    protected $fillable = [
        'user_id',   // The user associated with the basket item
        'car_id',    // The car associated with the basket item
        'quantity',  // Quantity of the car in the basket
    ];

    // Disable automatic timestamp management (DO NOT use created_at or updated_at)
    public $timestamps = false;

    // Define the relationship between the Basket and Cars models
    public function car()
    {
        // Use the correct model 'Cars' instead of 'Car'
        return $this->belongsTo(Cars::class, 'car_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
