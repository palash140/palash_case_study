<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Validation\ValidationException;

class GuestAuthSanctum
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next){

        if ($request->bearerToken()) {
            $user=Auth::guard('sanctum')->user();
            if(empty($user)){
                throw new AuthenticationException();
            }
            Auth::setUser($user);
        }

        if(empty($request->header('session_id'))){
              throw ValidationException::withMessages([
                    'session_id' => ['session_id required in heder']
                ]);
        }


        return $next($request);
    }
}
