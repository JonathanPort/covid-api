<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\BaseController;


/**
 * @group  Action Tokens
 *
 * API endpoints for User Notifications
 */
class NotificationsController extends BaseController
{


    public function __construct()
    {

        $this->middleware('JWTAuth')->except([
            //
        ]);

        $this->user = Auth::user();

    }


    /**
     * Get users notifications
     */
    public function getNotifications(Request $request)
    {

        //

    }



    /**
     * Mark notification as read
     */
    public function markNotificationAsRead(Request $request)
    {

        //

    }





}
