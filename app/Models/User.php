<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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
        'type_id',
    ];

    protected $hidden = [
        'password'
    ];

    protected $appends = [
        'user_type',
        'is_passenger'
    ];

    public function attempt($credentials) {
        $user = $this->newQuery()
            ->whereEmail($credentials['email'])
            ->first();
        
        if(!$user) {
            return null;
        }

        $isValid = Hash::check($credentials['password'], $user->getAuthPassword());
    
        return $isValid
            ? $user
            : null;
    }

    public function bookings() {
        return $this->hasMany(Booking::class);
    }

    public function byEmail($email) {
        return $this->newInstance()
            ->whereEmail($email)
            ->first();
    }

    public function cars() {
        return $this->hasMany(Car::class);
    }

    public function getUserTypeAttribute() {
        return $this->userType()->first();
    }

    public function getIsPassengerAttribute() {
        return $this->type_id === 1;
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

    public function setPasswordAttribute($password) {
        $this->attributes['password'] = Hash::make($password);
    }

    public function trips() {
        return $this->hasMany(Trip::class);
    }

    public function updateUser($id, $data) {
        $user = $this->find($id);
        $data = collect($data)->forget('email', 'type_id', 'id');
        $user->fill($data->all());
        $user->save();
        
        return $user;
    }

    public function userType() {
        return $this->belongsTo(UserType::class, 'type_id');
    }
}
