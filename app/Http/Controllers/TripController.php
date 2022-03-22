<?php

namespace App\Http\Controllers;

use App\Lib\Validator;
use App\Models\Trip;
use Illuminate\Http\Request;

class TripController extends Controller
{
    protected Trip $trip;
    protected Validator $validator;


    function __construct(Trip $trip, Validator $validator){
        $this->trip = $trip;
        $this->validator = $validator;
    }

    public function index() {
        return auth()->user()->type_id === 2 
            ? $this->trip->byDriverId(auth()->user()->id) 
            : $this->trip->all();
    }

    public function show($id) {
        $trip = $this->trip->find($id);

        return $trip;
    }

    public function store(Request $request) {
        $this->authorize('create', Trip::class);

        $this->validator->validate($request, [
            'date_time_begin' => ['required', 'date', 'after:today'],
            'price' => ['required', 'regex:/^\d+(\.\d{1,2})?$/'],
            'origin_address' => ['required'],
            'destination_address' => ['required']
        ]);

        return $this->trip->register($request->all());
    }
}
