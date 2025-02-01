<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cars extends Model
{
    use HasFactory;
    protected $table = 'cars';

    public static function randomCars(): \Illuminate\Database\Eloquent\Collection {

        return self::query()->inRandomOrder()->take(3)->get();
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'id', 'id');  // Linking cars.id with orders.id
    }

}
