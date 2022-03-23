<?php

namespace App\Policies;

use App\Models\Booking;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class BookingPolicy
{
    use HandlesAuthorization;

    public function create(User $user) {
        return $user->is_passenger;
    }

    public function interact(User $user, Booking $booking) {
        return $booking->user_id === $user->id;
    }
}
