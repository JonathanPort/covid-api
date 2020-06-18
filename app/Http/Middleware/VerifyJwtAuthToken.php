<?php

namespace App\Http\Middleware;

use Closure;
use JWTAuth;

class VerifyJwtAuthToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        try {

            $token = JWTAuth::parseToken();

        } catch (\Tymon\JWTAuth\Exceptions\JWTException $e) {

            return response()->json([
                'status' => 'missing_token',
            ], 422);

        }

        try {

            $token->authenticate();

        } catch (\Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {

            return response()->json([
                'status' => 'token_expired',
            ], 401);

        } catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {

            return response()->json([
                'status' => 'token_invalid',
            ], 401);

        }

        return $next($request);
    }
}
