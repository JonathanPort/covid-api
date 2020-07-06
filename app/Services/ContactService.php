<?php

namespace App\Services;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\UserContactRequest;
use App\Models\UserContact;
use App\Models\User;

class ContactService
{


    protected const REQUEST_STATUS__PENDING = 'pending';
    protected const REQUEST_STATUS__ACCEPTED = 'accepted';
    protected const REQUEST_STATUS__DECLINED = 'declined';


    public function __construct()
    {}


    public function newRequest(User $sender, User $reciever)
    {

        return UserContactRequest::create([
            'sender_id' => $sender->id,
            'reciever_id' => $reciever->id,
            'status' => self::REQUEST_STATUS__PENDING,
        ]);

    }


    public function declineRequest(UserContactRequest $request)
    {

        return $request->update([
            'status' => self::REQUEST_STATUS__DECLINED,
        ]);

    }


    public function acceptRequest(UserContactRequest $request)
    {

        return $request->update([
            'status' => self::REQUEST_STATUS__ACCEPTED,
        ]);

    }


    public function addNewContact(UserContactRequest $request)
    {

        $user = UserContact::create([
            'user_id' => $request->sender_id,
            'friend_id' => $request->reciever_id,
        ]);

        $friend = UserContact::create([
            'user_id' => $request->reciever_id,
            'friend_id' => $request->sender_id,
        ]);

        return true;

    }


    public function deleteContact(UserContact $userContactRecord)
    {

        $friendContactRecord = UserContact::find($userContactRecord->friend_id);

        if (! $friendContactRecord) throw new \Exception('missing_friend_record');

        $userContactRecord->delete();
        $friendContactRecord->delete();

        return true;

    }

}
