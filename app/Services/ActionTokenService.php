<?php

namespace App\Services;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\ActionToken;

class ActionTokenService
{


    protected $actions = [
        'addContact',
    ];


    public function verify(string $token)
    {

        $token = ActionToken::where('token', $token)->first();

        return $token ? $token : false;

    }


    public function generate(string $action, User $user)
    {

        if (! in_array($action, $this->actions)) throw new \Exception('action_not_recognised');

        return ActionToken::create([
            'user_id' => $user->id,
            'action' => $action,
        ]);

    }


    public function run()
    {
        # code...
    }

}
