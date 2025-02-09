<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cars extends Model
{
    protected $table = 'cars';  // The table is 'cars'

    protected $fillable = [
        'car_model',  // The model name of the car
        'price',      // The price of the car
        'colour',     // The color of the car
        'year',       // The year of the car
        'mileage',    // Mileage of the car
        'fuel',       // Fuel type of the car
        'transmission',  // Transmission type of the car
    ];

    /**
     * Get the ordered items associated with the car.
     */
    public function orderedItems()
    {
        return $this->hasMany(OrderedItems::class, 'car_id');  // 'car_id' is the foreign key in 'ordered_items'
    }

    /**
     * Get a random selection of cars.
     *
     * @param int $limit
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function randomCars($limit = 3)
    {
        return self::inRandomOrder()->limit($limit)->get();  // Randomly order and limit the results
    }
}
