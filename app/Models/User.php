<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $fillable = [
        'email',
        'name',
        'password',
        'type',
    ];

    protected $hidden = [
        'password'
    ];

    public function bookings() {
        return $this->hasMany(Booking::class);
    }

    public function car() {
        return $this->hasMany(Car::class);
    }

    public function register($data) {
        $instance = $this->newInstance($data);
        $instance->email_verify_token = Str::random(60);
        $instance->save();

        return $instance;
    }

    public function trips() {
        return $this->hasMany(Trip::class);
    }
}
