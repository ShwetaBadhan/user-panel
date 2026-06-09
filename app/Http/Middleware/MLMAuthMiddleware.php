<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class MLMAuthMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!Session::get('logged_in')) {
            return redirect()->route('login')->withErrors(['msg' => 'Please login to continue.']);
        }

        return $next($request);
    }
}