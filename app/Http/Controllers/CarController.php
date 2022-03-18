<?php

namespace App\Http\Controllers;

use App\Lib\Validator;
use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Request as FacadesRequest;

class CarController extends Controller
{
    protected Car $car;

    function __construct(Car $car, Validator $validator){
        $this->car = $car;
        $this->validator = $validator;
    }

    public function delete(Request $request) {
        $car = $this->car->find($request->id);
        $this->authorize('interact', $car);
        $car->delete();

        return response()->json("Car sucessfully deleted", Response::HTTP_NO_CONTENT);
    }

    public function index() {
        return $this->car->all();
    }

    public function store(Request $request) {
        // Calls CarPolicy's create function
        $this->authorize('create', Car::class);

        $this->validator->validate($request, [
            'color' => ['required'],
            'model' => ['required'],
            'plate' => ['required', 'min:8', 'max:10', 'unique:cars'],
            'year' => ['required', 'integer', 'between:2005,2022'],
            'seats' => ['required'],
        ]);

        return $this->car->store($request->all());
    }

    public function show($id) {
        $car = $this->car->find($id);
        $this->authorize('interact', $car);

        return $car;
    }
}
