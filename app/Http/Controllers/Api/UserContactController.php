<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\BaseController;


/**
 * @group  Contact Forms
 *
 * API endpoints for managing contact forms
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


    public function newContactFromActionCode(Request $request)
    {
        # code...
    }




}
