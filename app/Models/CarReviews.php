<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarReviews extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'car_id', 'rating', 'review'];

    // Define the relationship with the User model
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Define the relationship with the Car model
    public function car()
    {
        return $this->belongsTo(Cars::class);
    }
}
