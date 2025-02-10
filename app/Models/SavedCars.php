<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Relations\BelongsTo;
    class SavedCars extends Model
    {
        use HasFactory;

        protected $table = 'saved_items';

        protected $fillable = [
            'user_id',
            'car_id',
            'saved_date'
        ];
        public $timestamps = false;
        public function user(): BelongsTo
        {
            return $this->belongsTo(User::class);
        }

        // Define the relationship with the Car model
        public function car(): BelongsTo
        {
            return $this->belongsTo(Cars::class);
        }
    }
