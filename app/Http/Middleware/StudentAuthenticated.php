<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class StudentAuthenticated
{
    /**
     * Verify the student is authenticated via the student guard.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::guard('student')->check()) {
            return redirect()->route('login')
                             ->with('error', 'Please log in to access the portal.');
        }

        // Block deactivated accounts
        if (!Auth::guard('student')->user()->is_active) {
            Auth::guard('student')->logout();
            return redirect()->route('login')
                             ->with('error', 'Your account has been deactivated. Contact the Registrar.');
        }

        return $next($request);
    }
}