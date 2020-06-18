<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Services\AuthService;
use App\Http\Controllers\Api\BaseController;

class AuthController extends BaseController
{

    public function __construct(AuthService $service)
    {

        $this->middleware('JWTAuth')->except([
            'loginViaEmail',
            'loginViaSso',
        ]);

        $this->service = $service;

    }


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
            'user' => \Auth::user(),
        ], 200, 'login_success');

    }


    public function loginViaSso(Request $request)
    {
        # code...
    }


    public function test()
    {
        return $this->response([
            'test' => '123',
            'testing' => '1234',
        ], 200);
    }

}
