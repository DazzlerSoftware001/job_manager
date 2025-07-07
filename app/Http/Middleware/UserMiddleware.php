<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class UserMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if the user is authenticated
        if (Auth::check() && Auth::user()->user_type == 0) {

            return $next($request);
        }

         // Check if AJAX or expects JSON
        if ($request->expectsJson()) {
            return response()->json([
                'status_code' => 0,
                'message' => 'You must be logged in to perform this action.',
                'redirect_url' => route('User.login')
            ], 401);
        }

        return redirect()->route('User.login');
    }
}
