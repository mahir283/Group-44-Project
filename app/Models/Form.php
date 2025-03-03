<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Form extends Model
{
    use HasFactory;

    protected $table = 'contact_form'; // Specify table name if it doesn't follow Laravel's plural naming convention

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone_number',
        'message',
    ];
}
