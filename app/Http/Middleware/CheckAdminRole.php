<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckAdminRole
{
      public function handle($request, Closure $next)
    {
        if (!$request->user() || $request->user()->rol != 'admin') {
            return redirect()->route('home')->with('message', 'You do not have the necessary permissions to access this page.');
        }

        return $next($request);
    }
}
