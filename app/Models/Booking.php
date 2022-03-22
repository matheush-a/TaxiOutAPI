<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $table = 'booking';

    protected $fillable = [
        'trip_id',
        'user_id'
    ];

    public function register($data) {
        $instance = $this->newInstance();
        $instance->user()->associate(auth()->user());
        $instance->trip()->associate($data['trip_id']);
        $instance->save();

        return $instance;
    }

    public function trip() {
        return $this->belongsTo(Trip::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

}
