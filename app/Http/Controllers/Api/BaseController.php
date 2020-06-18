<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BaseController extends Controller
{

    public function __construct()
    {

        //

    }


    protected function response(array $data, int $code = 200, string $status = null)
    {

        return response()->json([
            'code' => $code,
            'status' => $status,
            'data' => $data,
        ], $code);

    }

}
