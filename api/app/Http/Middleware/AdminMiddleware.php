<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()){
            if (Auth::user()->role_id == 1){
                return $next($request);
            }else{
                return response(['resp' => false,'message' => 'no tiene permiso'],Response::HTTP_UNAUTHORIZED);
            }
        }else{
            return response(['resp' => false,'message' => 'debe estar logeado'],Response::HTTP_UNPROCESSABLE_ENTITY);
        }

    }
}
