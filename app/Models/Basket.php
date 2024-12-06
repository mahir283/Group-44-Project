<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Basket extends Model
{
    use HasFactory;

    //tables which are associated with the 'basket' model
    protected $table = 'baskets';

    //attributes which i can mass align
    protected $fillable = [
        'user_id',   //the user associated with the basket item
        'car_id',    //the car associated with the basket item
        'quantity',  //quantity of the car in the basket
    ];

    //define the relationship between the Basket and the Car models
    public function car()
    {
        //the basket item belongs to a car (we link via car_id)
        return $this->belongsTo(Car::class, 'car_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
