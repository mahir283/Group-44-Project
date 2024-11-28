<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;
use Ramsey\Collection\Collection;

class Cars extends Model
{
    use HasFactory;
    protected $table = 'cars';

    public static function randomCars($limit = 3): \Illuminate\Database\Eloquent\Collection
    {
        return self::randomlySelectCar($limit);
    }

    protected static function randomlySelectCar($limit = 3): \Illuminate\Database\Eloquent\Collection
    {
        return self::query()->orderByRaw('RAND()')->limit($limit)->get();
    }
}
