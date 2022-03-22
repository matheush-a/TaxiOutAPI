<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    use HasFactory;

    protected $table = 'trip';

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

    public function byDriverId($id) {
        return $this->newInstance()->where('driver_id', $id)->get();
    }

    public function register($data) {
        $instance = $this->newInstance($data);
        $instance->user()->associate(auth()->user());
        $instance->status_id = 1;
        $instance->save();

        return $instance;
    }

    public function routes() {
        return $this->hasMany(Route::class);
    }

    public function tripStatus() {
        return $this->belongsTo(TripStatus::class,'status_id');
    }

    public function user() {
        return $this->belongsTo(User::class,'driver_id');
    }
}
