<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsureHrAdmin
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            return redirect()->route('admin.login')
                ->with('error', 'Please log in with your HR administrative credentials to access this area.');
        }

        if (!Auth::user()->isHrAdmin()) {
            Auth::logout();
            return redirect()->route('admin.login')
                ->with('error', 'Access restricted. You do not possess HR administrative privileges.');
        }

        return $next($request);
    }
}
