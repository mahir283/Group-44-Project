<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WebReview extends Model
{

    use hasFactory;

    protected $table = 'web_reviews';
    protected $fillable = ['user_id', 'rating', 'comment'];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
