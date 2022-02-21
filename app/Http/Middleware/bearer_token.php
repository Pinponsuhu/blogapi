<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class bearer_token
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
        $token='Bearer '.$request->bearerToken();
        $response=$next($request);
        $response->header('Authorization',$token);

        return $response;
    }
}
