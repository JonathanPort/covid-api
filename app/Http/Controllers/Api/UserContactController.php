<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\BaseController;
use App\Http\Resources\UserContactsResource;

/**
 * @group  User Contacts
 *
 * API endpoints for managing User Contacts
 */
class UserContactController extends BaseController
{


    public function __construct()
    {

        $this->middleware('JWTAuth')->except([
            //
        ]);

        $this->user = Auth::user();

    }


    /**
     * Get users contacts
     */
    public function getContacts(Request $request)
    {

        return $this->response([
            'contacts' => UserContactsResource::collection($this->user->contacts()->get()),
        ]);

    }




}
