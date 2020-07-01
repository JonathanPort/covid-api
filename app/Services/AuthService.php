<?php

namespace App\Services;

use Tymon\JWTAuth\Facades\JWTAuth;
use Laravel\Socialite\Facades\Socialite;
use Laravel\Socialite\AbstractUser;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Exception;
use App\Models\UserSsoAccount;
use App\Models\User;

class AuthService
{

    public function __construct()
    {}


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

        return JWTAuth::attempt([
            'email' => $email,
            'password' => $password,
        ]);

    }


    public function registerViaEmail(array $formData)
    {

        $name = isset($formData['name']) ? $formData['name'] : false;
        $email = isset($formData['email']) ? $formData['email'] : false;
        $password = isset($formData['password']) ? $formData['password'] : false;

        $validator = Validator::make([
            'name' => $name,
            'email' => $email,
            'password' => $password,
        ], [
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required',
        ]);

        $messages = $validator->messages();
        if (count($messages)) throw new \Exception(json_encode($messages));


        return User::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
        ]);

    }


    public function loginViaUserRecord(User $user)
    {

        return JWTAuth::fromUser($user);

    }


    public function generateAuthCode(User $user)
    {

        return JWTAuth::fromUser($user);

    }


    public function getUserFromSso(string $provider, string $code)
    {

        $token = Socialite::driver($provider)->getAccessTokenResponse($code);

        return Socialite::driver($provider)
                        ->stateless()
                        ->userFromToken($token['access_token']);

    }


    public function userExistsViaSso(int $id)
    {

        return UserSsoAccount::where('provider_id', $id)->first();

    }


    public function createUserFromSso(AbstractUser $ssoData, string $providerName)
    {

        $user = User::create([
            'name' => $ssoData->getName(),
            'email' => $ssoData->getEmail(),
            'avatar' => $ssoData->getAvatar(),
        ]);


        $user->createSsoAccount($ssoData, $providerName);

        return $user;

    }

}
