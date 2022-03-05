<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    use HasFactory;

    protected $casts = [
        'date_time_begin' => 'datetime'
    ];

    protected $fillable = [
        'date_time_begin',
        'destination_address',
        'driver_id',
        'origin_address',
        'price',
        'status_id',
    ];

    public function bookings() {
        return $this->hasMany(Booking::class);
    }

    public function routes() {
        return $this->hasMany(Route::class);
    }

    public function tripStatus() {
        return $this->belongsTo(TripStatus::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}
