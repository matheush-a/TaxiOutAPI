<?php

namespace App\Policies;

use App\Models\Car;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CarPolicy
{
    use HandlesAuthorization;

    public function create(User $user) {
        return !$user->is_passenger;
    }

    public function interact(User $user, Car $car) {
        return $car->user_id === $user->id;
    }
}