<?php

namespace App\Policies;

use App\Models\Car;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CarPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        //
    }

    public function view(User $user, Car $car)
    {
        //
    }

    public function create(User $user) {
        return $user->user_type->type === 'Taxista';
    }

    public function update(User $user, Car $car)
    {
        //
    }


    public function delete(User $user, Car $car)
    {
        return $car->user_id === $user->id;
    }

    public function restore(User $user, Car $car)
    {
        //
    }

    public function forceDelete(User $user, Car $car)
    {
        //
    }

    
}