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
     * @bodyParam action string required The key of the action
     * @bodyParam payload json           The request payload
     *
     * Available Actions:
     * 1. action: 'addContact', payload: {contact_id: 'user_id_here'}
     *
     * @response {token: token_object}
     */
    public function generateActionToken(Request $request)
    {

        $service = new ActionTokenService();

        $validator = Validator::make($request->all(), [
            'action' => 'required|string|in:addContact',
            'payload' => 'nullable|json'
        ]);

        if (! $validator->validate()) return $this->response([], 422, 'validation_error');

        $payload = $request->payload ? json_decode($request->payload) : null;


        try {
            $token = $service->generate($request->action, $this->user, $payload);
        } catch (\Exception $e) {

            return $this->response([$e->getMessage()], 422, 'unknown_action');

        }


        return $this->response([
            'token' => $token,
        ], 200, 'success');

    }


    /**
     * Run action token
     *
     * @bodyParam token required  The token
     */
    public function runActionToken(Request $request)
    {

        $service = new ActionTokenService();

        $validator = Validator::make($request->all(), [
            'token' => 'required|string',
        ]);

        if (! $validator->validate()) return $this->response([
            'messages' => [
                'token.required' => 'The action token is required.',
            ],
        ], 422, 'validation_error');


        try {
            $action = $service->run($request->token);
        } catch (\Exception $e) {

            return $this->response([], 422, 'action_token_invalid');

        }


        return $this->response([$action], 200, 'action_success');


    }

}
