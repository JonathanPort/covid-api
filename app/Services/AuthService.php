<?php

namespace App\Services;

use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthService
{

    public function __construct()
    {

    }


    public function loginViaEmail(string $email, string $password)
    {

        $validator = Validator::make([
            'email' => $email,
            'password' => $password,
        ], [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (! $validator->validate()) throw new \Exception('Invalid email or password.');

        return Auth::guard()->attempt([
            'email' => $email,
            'password' => $password,
        ]);

    }


    public function generateAuthCode(User $user)
    {

        return JWTAuth::fromUser($user);

    }

}
