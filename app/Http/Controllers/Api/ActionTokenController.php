<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Services\ActionTokenService;
use App\Http\Controllers\Api\BaseController;


/**
 * @group  Action Tokens
 *
 * API endpoints for running events via unique tokens associated to users
 */
class ActionTokenController extends BaseController
{


    public function __construct()
    {

        $this->middleware('JWTAuth')->except([
            //
        ]);

        $this->user = Auth::user();

    }

    /**
     * Generate Action Token
     *
     * @bodyParam action string  The key of the action
     *
     * @param Request $request
     *
     * @return void
     */
    public function generateActionToken(Request $request)
    {

        $service = new ActionTokenService();

        $validator = Validator::make($request->all(), [
            'action' => 'required|string',
            'params' => 'nullable|json'
        ]);

        if (! $validator->validate()) return $this->response([], 422, 'validation_error');


        try {
            $token = $service->generate($request->action, $this->user);
        } catch (\Exception $e) {

            return $this->response([], 422, 'unknown_action');

        }


        return $this->response([
            'token' => $token,
        ], 200, 'success');

    }


    /**
     * Run action token
     *
     * Action token
     */
    public function runActionToken(type $ = null)
    {
        # code...
    }

}
