<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cars extends Model
{
    use HasFactory;

    protected $table = 'cars';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'car_make',
        'car_model',
        'car_image',
        'car_description',
        'quantity',
        'price',
        'colour',
        'year',
        'mileage',
        'fuel',
        'transmission',
        'category',
    ];

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
