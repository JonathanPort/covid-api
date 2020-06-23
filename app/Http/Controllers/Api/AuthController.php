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
 * @group  Authentication
 *
 * API endpoints for creating users, logging in users and generating JWT token to
 * be used in all other user related requests.
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
     * Login user via email & password
     * @bodyParam  email string required The email of the user. Example: hello@jonathanport.com
     * @bodyParam  password string required The email of the user. Example: hello@jonathanport.com
     *
     * @response {
     *  "token": "token",
     *  "user": {"user object"}
     * }
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


    /**
     * Register user by email and password
     *
     * @bodyParam name string required
     * @bodyParam email string required
     * @bodyParam password string required
     *
     * @response {
     *  "new_user": "bool",
     *  "token": "token",
     *  "user": {"user object"}
     * }
     */
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


    // public function tempSsoRedirectToProvider()
    // {

    //     return Socialite::driver('facebook')->redirect();

    // }


    // public function tempSsoCallback(Request $request)
    // {
    //     dd($request->code);
    //     $token = Socialite::driver('facebook')->getAccessTokenResponse($request->code);

    //     $providerData = Socialite::driver('facebook')
    //                                  ->stateless()
    //                                  ->userFromToken($token['access_token']);

    //     dd($providerData);

    // }


    /**
     * Login or Register user by SSO auth code
     *
     * @bodyParam provider string required e.g. 'facebook', 'twitter' etc.
     * @bodyParam code string required  Auth code returned from social provider
     *
     * @response {
     *  "new_user": "bool",
     *  "token": "token",
     *  "user": {"user object"}
     * }
     */
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


    // public function test()
    // {
    //     return $this->response([
    //         'test' => '123',
    //         'testing' => '1234',
    //     ], 200);
    // }


}
