<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Lib\Validator;

class UserController extends Controller
{   
    protected User $user;
    protected Validator $validator;

    public function __construct(User $user, Validator $validator) {
        $this->user = $user;
        $this->validator = $validator;
    }

    public function store(Request $request) {
     
        $this->validator->validate($request, [
            'name' => ['required', 'min:3'],
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required', 'min:8'],
            'type' => ['required']
        ]);
    
        return $this->user->register($request->all());    
    }

    public function update() {

    }
}
