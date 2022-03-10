<?php

namespace App\Models;

use Carbon\Carbon;
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

    public function byEmail($email) {
        return $this->newInstance()
            ->whereEmail($email)
            ->first();
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

    public function setEmailVerified($user) {
        $user->email_verified_at = Carbon::now();
        $user->save();

        return $user;
    }

    public function trips() {
        return $this->hasMany(Trip::class);
    }
}
