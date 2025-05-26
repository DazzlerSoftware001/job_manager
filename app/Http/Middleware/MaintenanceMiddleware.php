<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\MaintenanceMode; 
use Illuminate\Support\Facades\Auth;

class MaintenanceMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $maintenance = MaintenanceMode::first();

        // If maintenance is ON
        if ($maintenance && $maintenance->maintenance == 1) {

            // Allow admin (user_type 1 or 2) to bypass
            if (Auth::check() && (Auth::user()->user_type == 1 || Auth::user()->user_type == 2)) {
                return $next($request);
            }

            // Redirect others to maintenance page
            return redirect()->route('User.MaintenanceMode');
        }

        // If maintenance is OFF, proceed normally
        return $next($request);
    }
}
