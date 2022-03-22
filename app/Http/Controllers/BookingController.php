<?php

namespace App\Http\Controllers;

use App\Lib\Validator;
use App\Models\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    protected Booking $booking;
    protected Validator $validator;

    function __construct(Booking $booking, Validator $validator) {
        $this->booking = $booking;
        $this->validator = $validator;
    }

    public function store(Request $request) {
        $this->validator->validate($request, [
            'trip_id' => ['required', 'integer', 'exists:trip,id']
        ]);
        
        return $this->booking->register($request->all());
    }
}
