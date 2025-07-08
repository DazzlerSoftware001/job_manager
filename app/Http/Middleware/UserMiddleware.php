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

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'status_code' => 0,
                'message' => 'Unauthenticated',
                'redirect' => route('User.login')
            ], 401);
        }
        
        return redirect()->route('User.login');
    }
}
