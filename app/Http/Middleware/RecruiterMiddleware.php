<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class RecruiterMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if the user is authenticated
        // if(Auth::check() && Auth::user()->user_type==2) {
            
        //     return $next($request);
        // }

        // return redirect()->route('Recruiter.login');
        
        if (Auth::check()) {
            $user = Auth::user();
    
            // Only allow user_type 2 and active status (1)
            if ($user->user_type == 2 && $user->status == 1) {
                return $next($request);
            }
    
            // Logout and redirect with error message
            Auth::logout();
            return redirect()->route('Recruiter.login')->with('error', 'Your account is not active.');
        }
    
        // If not logged in at all
        return redirect()->route('Recruiter.login')->with('error', 'Please login first.');
    
    }
}
