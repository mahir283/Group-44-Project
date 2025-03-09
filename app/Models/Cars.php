<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cars extends Model
{
    use HasFactory;

    protected $table = 'cars';
    public $timestamps = false;
    // Method to get random cars
    public static function randomCars($count = 3)
    {
        return self::query()->inRandomOrder()->take($count)->get();
    }

    // Define the relationship with the CarReviews model
    public function reviews()
    {
        return $this->hasMany(CarReviews::class, 'car_id', 'id');
    }
}
