<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class LogoutIfUnverfied
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    { {
            if (Auth::check() && Auth::user()->role == 'admin') {
                return redirect()->route('admin')->with('status', 'Please verify your email address.');
            }
        }
        if (Auth::check() && is_null(Auth::user()->email_verified_at)) {
            Auth::logout();

            return redirect()->route('login')->with('status', 'Please verify your email address.');
        }

        return $next($request);
    }
}
