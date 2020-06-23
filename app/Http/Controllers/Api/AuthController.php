<?php

namespace App\Http\Controllers\Api;

use Laravel\Socialite\Two\InvalidStateException;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use GuzzleHttp\Exception\ClientException;
use App\Services\AuthService;
use App\Models\User;
use App\Http\Controllers\Api\BaseController;
use App\Http\Resources\UserResource;


/**
 * @group  User Authentication
 *
 * API endpoints for creating, authenticating and logging in users.
 */
class AuthController extends BaseController
{

    public function __construct(AuthService $service)
    {

        $this->middleware('JWTAuth')->except([
            'loginViaEmail',
            'registerViaEmail',
            'loginViaSso',
            'tempSsoRedirectToProvider',
            'tempSsoCallback',
        ]);

        $this->service = $service;

    }


    /**
     * Login user
     * @bodyParam  user_id int required The id of the user. Example: 9
     *
     * @return void
     */
    public function loginViaEmail(Request $request)
    {

        try {
            $token = $this->service->loginViaEmail($request->email, $request->password);
        } catch (\Exception $e) {

            return $this->response([], 422, 'validation_error');

        }

        if (! $token) return $this->response([], 422, 'invalid_credentials');

        return $this->response([
            'token' => $token,
            'user' => new UserResource(Auth::user()),
        ], 200, 'login_success');

    }


    public function registerViaEmail(Request $request)
    {

        try {
            $user = $this->service->registerViaEmail($request->all());
        } catch (\Exception $e) {

            return $this->response(
                ['validation_errors' => json_decode($e->getMessage())],
                422,
                'validation_error'
            );

        }

        $token = $this->service->loginViaUserRecord($user);
        if (! $token) return $this->response([], 500, 'unknown_server_error');

        return $this->response([
            'new_user' => true,
            'token' => $token,
            'user' => new UserResource($user),
        ], 200, 'success');

    }


    public function tempSsoRedirectToProvider()
    {

        return Socialite::driver('facebook')->redirect();

    }


    public function tempSsoCallback(Request $request)
    {
        dd($request->code);
        $token = Socialite::driver('facebook')->getAccessTokenResponse($request->code);

        $providerData = Socialite::driver('facebook')
                                     ->stateless()
                                     ->userFromToken($token['access_token']);

        dd($providerData);

    }


    public function loginViaSso(Request $request)
    {

        // Attempt to get user data from SSO from auth code
        try {

            $providerData = $this->service->getUserFromSso($request->provider, $request->code);

        } catch (InvalidStateException $e) {

            return $this->response([], 500, 'invalid_state');

        } catch (ClientException $e) {

            return $this->response([$e], 401, 'token_expired_or_invalid');

        }


        // Find user
        $userSsoAccount = $this->service->userExistsViaSso($providerData->getId());

        if ($userSsoAccount) {

            $user = $userSsoAccount->user()->first();
            $newUser = false;

        } else {

            if (User::where('email', $providerData->getEmail())->first()) {
                return $this->response([], 409, 'account_exists_via_standard_email_login');
            }

            $user = $this->service->createUserFromSso($providerData, $request->provider);

            $newUser = true;

        }


        $token = $this->service->loginViaUserRecord($user);

        if (! $token) return $this->response([], 500, 'unknown_server_error');


        return $this->response([
            'new_user' => $newUser,
            'token' => $token,
            'user' => new UserResource($user),
        ], 200, 'success');

    }


    public function test()
    {
        return $this->response([
            'test' => '123',
            'testing' => '1234',
        ], 200);
    }


}
