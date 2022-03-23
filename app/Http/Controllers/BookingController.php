<?php

namespace App\Http\Controllers;

use App\Lib\Validator;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class BookingController extends Controller
{
    protected Booking $booking;
    protected Validator $validator;

    function __construct(Booking $booking, Validator $validator) {
        $this->booking = $booking;
        $this->validator = $validator;
    }

    public function store(Request $request) {
        $this->authorize('create', Booking::class);

        $this->validator->validate($request, [
            'trip_id' => ['required', 'integer', 'exists:trip,id']
        ]);

        $numberOfSeats = $this->booking
            ->find($request->trip_id)->trip
            ->user->cars()->first()->seats;

        $numberOfBookings = $this->booking
            ->byTripId($request->trip_id)->count();

        if($numberOfBookings >= $numberOfSeats) {
            return response()->json("This trip does not have any seat available", Response::HTTP_FORBIDDEN);
        }

        return $this->booking->register($request->all());
    }

    public function delete($id) {
        $booking = $this->booking->find($id);

        if(!$booking){
            return response()->json("Booking not found", Response::HTTP_NOT_FOUND);
        }

        $this->authorize('interact', $booking);
        $booking->delete();

        return response()->json("Booking sucessfully deleted", Response::HTTP_NO_CONTENT);
    }

    public function index() {
        return $this->booking::all();
    }

    public function show($id) {
        $booking = $this->booking->find($id);
        
        if(!$booking){
            return response()->json("Booking not found", Response::HTTP_NOT_FOUND);
        }
  
        if(auth()->user()->is_passenger) {
            $booking->load('trip');
            $booking->trip->load('user');
            $booking->trip->user->load('cars');

            return $booking;
        }

        $booking->load('user');

        return $booking;
    }
}
