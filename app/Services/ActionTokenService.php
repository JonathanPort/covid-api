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


    public function generate(string $action, User $user, $payload = null)
    {

        if (! in_array($action, $this->actions)) throw new \Exception('action_not_recognised');

        return ActionToken::create([
            'user_id' => $user->id,
            'action' => $action,
            'payload' => $payload ? json_encode($payload) : null,
        ]);

    }


    public function run(string $token)
    {

        $token = ActionToken::where('token', $token)->first();

        if (! $token) throw new \Exception('token_not_recognised');

        switch ($token->action) {

            case 'addContact':

                return $this->newContact($token);

                break;

        }


    }


    private function newContact(ActionToken $token)
    {

        $service = new ContactService();

        $payload = json_decode($token->payload);

        $contactId = $payload->contact_id;

        if (! $contactId) throw new \Exception('Missing "contact_id" in payload.');

        $contactToAdd = User::find($contactId);

        if (! $contactToAdd) throw new \Exception('no user found with contact_id: ' . $contactId);

        if (Auth::id() === $contactId) throw new \Exception('User cannot add themselves.');

        $request = $service->newRequest($contactToAdd, Auth::user());

        $service->acceptRequest($request);

        try {
            $contact = $service->addNewContact($request);
        } catch (\Exception $e) {
            return $e->getMessage();
        }

        return $contact;

    }


}
