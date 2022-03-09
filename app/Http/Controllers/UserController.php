<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Lib\Validator;
use App\Mail\EmailVerify;
use Exception;
use Illuminate\Support\Facades\Mail;

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
            'email' => ['required', 'email', 'unique:users'],
            'emailRedirect' => ['required'],
            'name' => ['required', 'min:3'],
            'password' => ['required', 'min:8'],
            'type' => ['required'],
        ]);
    
        $user = $this->user->register($request->all());

        $link = $request->emailRedirect
            .'?userMail='.$user->email
            .'&userHash='.$user->email_verify_token;

        Mail::to($user->email)
            ->send(new EmailVerify($user, $link));
        
        return $user;
    }

    public function update() {

    }
}
