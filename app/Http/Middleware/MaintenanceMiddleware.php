<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\MaintenanceMode;

class MaintenanceMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if the user is authenticated
        if(Auth::check() && Auth::user()->user_type==1) {
            
            return $next($request);
        }

        return redirect()->route('User.MaintenanceMode');
    }
}
