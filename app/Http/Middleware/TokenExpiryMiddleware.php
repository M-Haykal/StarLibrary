<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Laravel\Sanctum\PersonalAccessToken;
use Carbon\Carbon;

class TokenExpiryMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $token = $request->bearerToken();

        if ($token) {
            $accessToken = PersonalAccessToken::findToken($token);

            if ($accessToken) {
                $createdAt = $accessToken->created_at;
                $expiresAt = $createdAt->addHours(2);

                if (Carbon::now()->greaterThan($expiresAt)) {
                    return response()->json(['error' => 'Token has expired.'], 401);
                }
            }
        }

        return $next($request);
    }
}
